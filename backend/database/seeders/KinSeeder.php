<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kin;

class KinSeeder extends Seeder
{
    public function run(): void
    {
        $solarSeals = [
            1 => ['Dragon', 'Dragón', 'Red', 'Rojo', 'Birth', 'Nacimiento', 'Nurtures', 'Nutre', 'Being', 'Ser'],
            2 => ['Wind', 'Viento', 'White', 'Blanco', 'Spirit', 'Espíritu', 'Communicates', 'Comunica', 'Breath', 'Aliento'],
            3 => ['Night', 'Noche', 'Blue', 'Azul', 'Abundance', 'Abundancia', 'Dreams', 'Sueña', 'Intuition', 'Intuición'],
            4 => ['Seed', 'Semilla', 'Yellow', 'Amarillo', 'Flowering', 'Florecimiento', 'Targets', 'Enfoca', 'Awareness', 'Conciencia'],
            5 => ['Serpent', 'Serpiente', 'Red', 'Rojo', 'Life Force', 'Fuerza Vital', 'Survives', 'Sobrevive', 'Instinct', 'Instinto'],
            6 => ['World-Bridger', 'Puente del Mundo', 'White', 'Blanco', 'Death', 'Muerte', 'Equalizes', 'Equilibra', 'Opportunity', 'Oportunidad'],
            7 => ['Hand', 'Mano', 'Blue', 'Azul', 'Accomplishment', 'Logro', 'Knows', 'Conoce', 'Healing', 'Sanación'],
            8 => ['Star', 'Estrella', 'Yellow', 'Amarillo', 'Elegance', 'Elegancia', 'Beautifies', 'Embellece', 'Art', 'Arte'],
            9 => ['Moon', 'Luna', 'Red', 'Rojo', 'Universal Water', 'Agua Universal', 'Purifies', 'Purifica', 'Flow', 'Flujo'],
            10 => ['Dog', 'Perro', 'White', 'Blanco', 'Heart', 'Corazón', 'Loves', 'Ama', 'Loyalty', 'Lealtad'],
            11 => ['Monkey', 'Mono', 'Blue', 'Azul', 'Magic', 'Magia', 'Plays', 'Juega', 'Illusion', 'Ilusión'],
            12 => ['Human', 'Humano', 'Yellow', 'Amarillo', 'Free Will', 'Libre Albedrío', 'Influences', 'Influye', 'Wisdom', 'Sabiduría'],
            13 => ['Skywalker', 'Caminante del Cielo', 'Red', 'Rojo', 'Space', 'Espacio', 'Explores', 'Explora', 'Wakefulness', 'Alerta'],
            14 => ['Wizard', 'Mago', 'White', 'Blanco', 'Timelessness', 'Atemporalidad', 'Enchants', 'Encanta', 'Receptivity', 'Receptividad'],
            15 => ['Eagle', 'Águila', 'Blue', 'Azul', 'Vision', 'Visión', 'Creates', 'Crea', 'Mind', 'Mente'],
            16 => ['Warrior', 'Guerrero', 'Yellow', 'Amarillo', 'Intelligence', 'Inteligencia', 'Questions', 'Pregunta', 'Fearlessness', 'Intrépidez'],
            17 => ['Earth', 'Tierra', 'Red', 'Rojo', 'Navigation', 'Navegación', 'Evolves', 'Evoluciona', 'Synchronicity', 'Sincronicidad'],
            18 => ['Mirror', 'Espejo', 'White', 'Blanco', 'Endlessness', 'Infinito', 'Reflects', 'Refleja', 'Order', 'Orden'],
            19 => ['Storm', 'Tormenta', 'Blue', 'Azul', 'Self-generation', 'Autogeneración', 'Catalyzes', 'Cataliza', 'Energy', 'Energía'],
            20 => ['Sun', 'Sol', 'Yellow', 'Amarillo', 'Universal Fire', 'Fuego Universal', 'Enlightens', 'Ilumina', 'Life', 'Vida'],
        ];

        $galacticTones = [
            1 => ['Magnetic', 'Magnético', 'Purpose', 'Propósito', 'Unify', 'Unificar', 'Attract', 'Atraer'],
            2 => ['Lunar', 'Lunar', 'Challenge', 'Desafío', 'Polarize', 'Polarizar', 'Stabilize', 'Estabilizar'],
            3 => ['Electric', 'Eléctrico', 'Service', 'Servicio', 'Activate', 'Activar', 'Bond', 'Unir'],
            4 => ['Self-Existing', 'Autoexistente', 'Form', 'Forma', 'Define', 'Definir', 'Measure', 'Medir'],
            5 => ['Overtone', 'Armónico', 'Radiance', 'Resplandor', 'Empower', 'Potenciar', 'Command', 'Comandar'],
            6 => ['Rhythmic', 'Rítmico', 'Equality', 'Igualdad', 'Organize', 'Organizar', 'Balance', 'Equilibrar'],
            7 => ['Resonant', 'Resonante', 'Attunement', 'Afinación', 'Channel', 'Canalizar', 'Inspire', 'Inspirar'],
            8 => ['Galactic', 'Galáctico', 'Integrity', 'Integridad', 'Harmonize', 'Armonizar', 'Model', 'Modelar'],
            9 => ['Solar', 'Solar', 'Intention', 'Intención', 'Pulse', 'Pulsar', 'Realize', 'Realizar'],
            10 => ['Planetary', 'Planetario', 'Manifestation', 'Manifestación', 'Perfect', 'Perfeccionar', 'Produce', 'Producir'],
            11 => ['Spectral', 'Espectral', 'Liberation', 'Liberación', 'Dissolve', 'Disolver', 'Release', 'Liberar'],
            12 => ['Crystal', 'Cristal', 'Cooperation', 'Cooperación', 'Dedicate', 'Dedicar', 'Universalize', 'Universalizar'],
            13 => ['Cosmic', 'Cósmico', 'Presence', 'Presencia', 'Endure', 'Endurecer', 'Transcend', 'Transcender'],
        ];

        $gapDays = [
            4, 12, 19, 27, 30, 35, 42, 44, 51, 59, 66, 68, 73, 80, 88, 95, 102,
            109, 116, 123, 130, 138, 145, 152, 159, 167, 174, 181, 188, 195, 203, 210,
            218, 225, 232, 239, 246, 253, 260
        ];

        $coreDays = [7, 20, 33, 46, 59, 72, 85, 98, 111, 124, 137, 150, 163, 176, 189, 202, 215, 228, 241, 254];

        for ($i = 1; $i <= 260; $i++) {
            $sealIndex = ($i - 1) % 20 + 1;
            $toneIndex = (($i - 1) % 13) + 1;

            $seal = $solarSeals[$sealIndex];
            $tone = $galacticTones[$toneIndex];

            $wavespellId = (int)ceil($i / 13);
            $castleId = (int)ceil($wavespellId / 4);

            Kin::create([
                'kin_number' => $i,
                'solar_seal' => $seal[0],
                'solar_seal_es' => $seal[1],
                'galactic_tone' => $toneIndex,
                'galactic_tone_name' => $tone[0],
                'color' => $seal[2],
                'color_es' => $seal[3],
                'power' => $seal[4],
                'power_es' => $seal[5],
                'action' => $seal[6],
                'action_es' => $seal[7],
                'essence' => $seal[8],
                'essence_es' => $seal[9],
                'description' => null,
                'description_es' => null,
                'is_gap' => in_array($i, $gapDays),
                'is_core_day' => in_array($i, $coreDays),
                'wavespell_id' => $wavespellId,
                'castle_id' => $castleId,
            ]);
        }
    }
}
