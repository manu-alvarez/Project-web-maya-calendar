import axios from 'axios';

const API_BASE_URL = 'http://localhost:8000/api';

async function diagnose() {
  console.log('🔍 DIAGNÓSTICO DE RESPUESTAS API (DATOS REALES)\n');

  try {
    // 1. Diagnóstico /calendar/today
    console.log('--- GET /calendar/today ---');
    const today = await axios.get(`${API_BASE_URL}/calendar/today`);
    console.log(JSON.stringify(today.data, null, 2));
    
    const kinNumber = today.data.kin?.kin_number;
    console.log(`\nKin Number detectado: ${kinNumber}`);

    if (kinNumber) {
      // 2. Diagnóstico /calendar/oracle/{kin}
      console.log(`\n--- GET /calendar/oracle/${kinNumber} ---`);
      const oracle = await axios.get(`${API_BASE_URL}/calendar/oracle/${kinNumber}`);
      console.log(JSON.stringify(oracle.data, null, 2));
    }

    // 3. Diagnóstico /calendar/wavespell/1
    console.log('\n--- GET /calendar/wavespell/1 ---');
    const wavespell = await axios.get(`${API_BASE_URL}/calendar/wavespell/1`);
    console.log(JSON.stringify(wavespell.data, null, 2));

    // 4. Diagnóstico /calendar/castle/1
    console.log('\n--- GET /calendar/castle/1 ---');
    const castle = await axios.get(`${API_BASE_URL}/calendar/castle/1`);
    console.log(JSON.stringify(castle.data, null, 2));

  } catch (error) {
    console.error('\n❌ ERROR EN DIAGNÓSTICO:');
    console.error(error.message);
    if (error.response) {
      console.error('Status:', error.response.status);
      console.error('Data:', JSON.stringify(error.response.data, null, 2));
    }
  }
}

diagnose();