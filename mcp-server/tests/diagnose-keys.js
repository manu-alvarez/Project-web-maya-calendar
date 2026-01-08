import axios from 'axios';

const API_BASE_URL = 'http://localhost:8000/api';

async function diagnoseKeys() {
  console.log('🔍 DIAGNÓSTICO DE CLAVES\n');

  try {
    const wavespell = await axios.get(`${API_BASE_URL}/calendar/wavespell/1`);
    console.log('Wavespell Keys:', Object.keys(wavespell.data));
    
    const castle = await axios.get(`${API_BASE_URL}/calendar/castle/1`);
    console.log('Castle Keys:', Object.keys(castle.data));

  } catch (error) {
    console.error(error.message);
  }
}

diagnoseKeys();