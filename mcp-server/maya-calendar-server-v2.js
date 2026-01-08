#!/usr/bin/env node

const express = require('express');
const axios = require('axios');
const { Server } = require('@modelcontextprotocol/sdk');

const API_BASE_URL = process.env.API_BASE_URL || 'http://localhost:8000/api';
const PORT = 3000;
const LOG_LEVEL = process.env.LOG_LEVEL || 'info';
const METRICS_ENABLED = process.env.METRICS_ENABLED === 'true';

let authToken = null;
let metrics = [];

const server = new Server(
  {
    name: 'Maya Calendar Server v2.0',
    version: '2.0.0',
  },
  {
    capabilities: {
      tools: {},
    },
  }
);

const logger = {
  info: (message, data) => log('INFO', message, data),
  warn: (message, data) => log('WARN', message, data),
  error: (message, data) => log('ERROR', message, data),
  debug: (message, data) => log('DEBUG', message, data),
};

function log(level, message, data = {}) {
  const timestamp = new Date().toISOString();
  const logEntry = {
    timestamp,
    level,
    message,
    ...data
  };

  if (shouldLog(level)) {
    console.error(JSON.stringify(logEntry));
  }
}

function shouldLog(level) {
  const levels = { DEBUG: 0, INFO: 1, WARN: 2, ERROR: 3 };
  return levels[level] >= levels[LOG_LEVEL];
}

function startMetrics(toolName, request) {
  if (!METRICS_ENABLED) return null;

  return {
    toolName,
    startTime: Date.now(),
    platform: request.platform || 'unknown',
    userId: request.userId || 'anonymous'
  };
}

function recordMetrics(metrics, result) {
  if (!METRICS_ENABLED) return;

  const endTime = Date.now();
  metrics.endTime = endTime;
  metrics.duration = endTime - metrics.startTime;
  metrics.success = !result.isError;
  metrics.timestamp = new Date().toISOString();

  metrics.push(metrics);
  
  logger.info(`Tool ${metrics.toolName} completed`, {
    duration: metrics.duration,
    success: metrics.success,
    platform: metrics.platform
  });

  return result;
}

function validateKinNumber(kinNumber) {
  if (!kinNumber || typeof kinNumber !== 'number') {
    return {
      content: [{
        type: 'error',
        text: 'Invalid kin_number parameter: must be a number between 1 and 260'
      }],
      isError: true,
      error: {
        code: 'INVALID_PARAM',
        message: 'Kin number must be between 1 and 260'
      }
    };
  }

  if (kinNumber < 1 || kinNumber > 260) {
    return {
      content: [{
        type: 'error',
        text: 'Kin number must be between 1 and 260'
      }],
      isError: true,
      error: {
        code: 'INVALID_RANGE',
        message: 'Kin number must be between 1 and 260'
      }
    };
  }

  return null;
}

function validateDate(date) {
  if (!date || typeof date !== 'string') {
    return {
      content: [{
        type: 'error',
        text: 'Invalid date parameter: must be a string in YYYY-MM-DD format'
      }],
      isError: true,
      error: {
        code: 'INVALID_PARAM',
        message: 'Date must be in YYYY-MM-DD format'
      }
    };
  }

  const dateRegex = /^\d{4}-\d{2}-\d{2}$/;
  if (!dateRegex.test(date)) {
    return {
      content: [{
        type: 'error',
        text: 'Invalid date format: must be YYYY-MM-DD'
      }],
      isError: true,
      error: {
        code: 'INVALID_FORMAT',
        message: 'Date must be in YYYY-MM-DD format'
      }
    };
  }

  return null;
}

server.setRequestHandler(async (request) => {
  try {
    const { method, params } = request;

    switch (method) {
      case 'tools/list':
        return {
          tools: [
            {
              name: 'get_today_kin',
              description: 'Obtener kin de hoy del calendario Maya (datos REALES de producción)',
              inputSchema: {
                type: 'object',
                properties: {}
              }
            },
            {
              name: 'get_kin_by_date',
              description: 'Obtener kin por fecha específica (datos REALES de producción)',
              inputSchema: {
                type: 'object',
                properties: {
                  date: {
                    type: 'string',
                    description: 'Fecha en formato YYYY-MM-DD'
                  }
                },
                required: []
              }
            },
            {
              name: 'get_kin_by_number',
              description: 'Obtener kin por número 1-260 (datos REALES de producción)',
              inputSchema: {
                type: 'object',
                properties: {
                  kin_number: {
                    type: 'number',
                    description: 'Número de kin (1-260)',
                    minimum: 1,
                    maximum: 260
                  }
                },
                required: ['kin_number']
              }
            },
            {
              name: 'calculate_oracle',
              description: 'Calcular oráculo Maya completo (datos REALES de producción)',
              inputSchema: {
                type: 'object',
                properties: {
                  kin_number: {
                    type: 'number',
                    description: 'Número de kin (1-260)',
                    minimum: 1,
                    maximum: 260
                  }
                },
                required: ['kin_number']
              }
            },
            {
              name: 'get_wavespell',
              description: 'Obtener wavespell por número (datos REALES de producción)',
              inputSchema: {
                type: 'object',
                properties: {
                  wavespell_number: {
                    type: 'number',
                    description: 'Número de wavespell (1-20)',
                    minimum: 1,
                    maximum: 20
                  }
                },
                required: ['wavespell_number']
              }
            },
            {
              name: 'get_castle',
              description: 'Obtener castle por número (datos REALES de producción)',
              inputSchema: {
                type: 'object',
                properties: {
                  castle_number: {
                    type: 'number',
                    description: 'Número de castle (1-5)',
                    minimum: 1,
                    maximum: 5
                  }
                },
                required: ['castle_number']
              }
            }
          ]
        };

      case 'tools/call': {
        const { name, arguments: args } = params;
        const metricsData = startMetrics(name, request);

        switch (name) {
          case 'get_today_kin':
            return recordMetrics(metricsData, await getTodayKin());
          case 'get_kin_by_date':
            return recordMetrics(metricsData, await getKinByDate(args));
          case 'get_kin_by_number':
            const validationError = validateKinNumber(args.kin_number);
            if (validationError) {
              return recordMetrics(metricsData, validationError);
            }
            return recordMetrics(metricsData, await getKinByNumber(args));
          case 'calculate_oracle':
            const validationError = validateKinNumber(args.kin_number);
            if (validationError) {
              return recordMetrics(metricsData, validationError);
            }
            return recordMetrics(metricsData, await calculateOracle(args));
          case 'get_wavespell':
            return recordMetrics(metricsData, await getWavespell(args));
          case 'get_castle':
            return recordMetrics(metricsData, await getCastle(args));
          default:
            return recordMetrics(metricsData, {
              content: [{
                type: 'error',
                text: `Tool unknown: ${name}`
              }],
              isError: true,
              error: {
                code: 'UNKNOWN_TOOL',
                message: `Tool ${name} not found`
              }
            });
        }
      }

      default:
        throw new Error(`Method unknown: ${method}`);
    }
  } catch (error) {
    logger.error('Error handling request', {
      error: error.message,
      stack: error.stack
    });
    return {
      content: [{
        type: 'error',
        text: `Error: ${error.message}`
      }],
      isError: true,
      error: {
        code: 'INTERNAL_ERROR',
        message: error.message
      }
    };
  }
});

async function getTodayKin() {
  logger.info('Calling API REST: GET /calendar/today');

  const response = await axios.get(`${API_BASE_URL}/calendar/today`);
  
  logger.info('API Response received', {
    statusCode: response.status,
    dataSize: JSON.stringify(response.data).length
  });

  return {
    content: [
      {
        type: 'text',
        text: JSON.stringify(response.data, null, 2)
      }
    ]
  };
}

async function getKinByDate({ date }) {
  const validationError = validateDate(date);
  if (validationError) {
    return validationError;
  }

  logger.info('Calling API REST: GET /calendar/date/' + date);

  const response = await axios.get(`${API_BASE_URL}/calendar/date/${date}`);
  
  logger.info('API Response received', {
    statusCode: response.status,
    dataSize: JSON.stringify(response.data).length
  });

  return {
    content: [
      {
        type: 'text',
        text: JSON.stringify(response.data, null, 2)
      }
    ]
  };
}

async function getKinByNumber({ kin_number }) {
  logger.info('Calling API REST: GET /calendar/kin/' + kin_number);

  const response = await axios.get(`${API_BASE_URL}/calendar/kin/${kin_number}`);
  
  logger.info('API Response received', {
    statusCode: response.status,
    kinNumber: kin_number,
    dataSize: JSON.stringify(response.data).length
  });

  return {
    content: [
      {
        type: 'text',
        text: JSON.stringify(response.data, null, 2)
      }
    ]
  };
}

async function calculateOracle({ kin_number }) {
  logger.info('Calling API REST: GET /calendar/oracle/' + kin_number);

  const response = await axios.get(`${API_BASE_URL}/calendar/oracle/${kin_number}`);
  
  logger.info('API Response received', {
    statusCode: response.status,
    kinNumber: kin_number,
    dataSize: JSON.stringify(response.data).length
  });

  return {
    content: [
      {
        type: 'text',
        text: JSON.stringify(response.data, null, 2)
      }
    ]
  };
}

async function getWavespell({ wavespell_number }) {
  logger.info('Calling API REST: GET /calendar/wavespell/' + wavespell_number);

  const response = await axios.get(`${API_BASE_URL}/calendar/wavespell/${wavespell_number}`);
  
  logger.info('API Response received', {
    statusCode: response.status,
    wavespellNumber: wavespell_number,
    dataSize: JSON.stringify(response.data).length
  });

  return {
    content: [
      {
        type: 'text',
        text: JSON.stringify(response.data, null, 2)
      }
    ]
  };
}

async function getCastle({ castle_number }) {
  logger.info('Calling API REST: GET /calendar/castle/' + castle_number);

  const response = await axios.get(`${API_BASE_URL}/calendar/castle/${castle_number}`);
  
  logger.info('API Response received', {
    statusCode: response.status,
    castleNumber: castle_number,
    dataSize: JSON.stringify(response.data).length
  });

  return {
    content: [
      {
        type: 'text',
        text: JSON.stringify(response.data, null, 2)
      }
    ]
  };
}

async function startServer() {
  app.listen(PORT, () => {
    logger.info('🚀 Maya Calendar MCP Server v2.0 iniciado', {
      port: PORT,
      apiBaseUrl: API_BASE_URL,
      logLevel: LOG_LEVEL,
      metricsEnabled: METRICS_ENABLED
    });
    logger.info('📡 Conectado a API REST', {
      url: API_BASE_URL
    });
    logger.info('🔧 MCP disponible para agentes de IA', {
      tools: 6,
      protocol: 'MCP'
    });
    logger.info('✅ Sistema listo para uso con 100% datos REALES de producción', {
      noMocks: true,
      noFakes: true,
      noDemoData: true
    });
  });
}

if (require.main === module) {
  startServer();
}

module.exports = server;
