import axios from 'axios';

const API_BASE_URL = 'http://localhost:8000/api';

async function diagnoseStructure() {
  console.log('🔍 DIAGNÓSTICO DE ESTRUCTURA JSON\n');

  try {
    // 1. Today
    console.log('--- Today ---');
    const today = await axios.get(`${API_BASE_URL}/calendar/today`);
    console.log(JSON.stringify(today.data, null, 2));

    // 2. Wavespell
    console.log('\n--- Wavespell ---');
    const wavespell = await axios.get(`${API_BASE_URL}/calendar/wavespell/1`);
    console.log(JSON.stringify(wavespell.data, null, 2));

    // 3. Castle
    console.log('\n--- Castle ---');
    const castle = await axios.get(`${API_BASE_URL}/calendar/castle/1`);
    console.log(JSON.stringify(castle.data, null, 2));

  } catch (error) {
    console.error(error.message);
  }
}

diagnoseStructure();