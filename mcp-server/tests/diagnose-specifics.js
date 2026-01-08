import axios from 'axios';

const API_BASE_URL = 'http://localhost:8000/api';

async function diagnoseSpecifics() {
  console.log('🔍 DIAGNÓSTICO ESPECÍFICO DE FALLOS\n');

  try {
    // 1. Test 1: Kin de hoy
    console.log('--- Test 1: Kin de hoy ---');
    const today = await axios.get(`${API_BASE_URL}/calendar/today`);
    console.log('today.data.kin.kin_number:', today.data.kin?.kin_number);
    console.log('Type:', typeof today.data.kin?.kin_number);

    // 2. Test 4: Oráculo del Kin 7
    console.log('\n--- Test 4: Oráculo Kin 7 ---');
    try {
      const oracle7 = await axios.get(`${API_BASE_URL}/calendar/oracle/7`);
      console.log('oracle7.data:', JSON.stringify(oracle7.data, null, 2));
    } catch (e) {
      console.log('Error obteniendo oráculo 7:', e.message);
    }

    // 3. Test 5: Wavespell 1
    console.log('\n--- Test 5: Wavespell 1 ---');
    const wavespell1 = await axios.get(`${API_BASE_URL}/calendar/wavespell/1`);
    console.log('wavespell1.data.id:', wavespell1.data.id);
    console.log('Type:', typeof wavespell1.data.id);

    // 4. Test 6: Castle 1
    console.log('\n--- Test 6: Castle 1 ---');
    const castle1 = await axios.get(`${API_BASE_URL}/calendar/castle/1`);
    console.log('castle1.data.id:', castle1.data.id);
    console.log('Type:', typeof castle1.data.id);

  } catch (error) {
    console.error('\n❌ ERROR EN DIAGNÓSTICO:', error.message);
  }
}

diagnoseSpecifics();