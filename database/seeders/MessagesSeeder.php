<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Message;
use App\Models\Animal;

class MessagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $animal1 = Animal::where('title', 'Elveszett leonbergit keresi szerető családja!')->first();
        $animal2 = Animal::where('title', 'Buksit keresem!')->first();
        $animal3 = Animal::where('title', 'Szilveszter óta keressük Micit')->first();

        $messages = [
            [
                'subject' => 'Érdeklődés a kutyus koráról',
                'message' => 'Ulysses, Ulysses — Soaring through all the galaxies. In search of Earth, flying in to the night. Ulysses, Ulysses — Fighting evil and tyranny, with all his power, and with all of his might. Ulysses — no-one else can do the things you do. Ulysses — like a bolt of thunder from the blue. Ulysses — always fighting all the evil forces bringing peace and justice to all.',
                'from_id' => 1,
                'to_id' => 3,
                'animal_id' => $animal3->id
            ],
            [
                'subject' => 'Van e betegsege?',
                'message' => 'Ulysses, Ulysses — Soaring through all the galaxies. In search of Earth, flying in to the night. Ulysses, Ulysses — Fighting evil and tyranny, with all his power, and with all of his might. Ulysses — no-one else can do the things you do. Ulysses — like a bolt of thunder from the blue. Ulysses — always fighting all the evil forces bringing peace and justice to all.',
                'from_id' => 3,
                'to_id' => 1,
                'animal_id' => $animal1->id
            ],
            [
                'subject' => 'Hány éves?',
                'message' => 'Ulysses, Ulysses — Soaring through all the galaxies. In search of Earth, flying in to the night. Ulysses, Ulysses — Fighting evil and tyranny, with all his power, and with all of his might. Ulysses — no-one else can do the things you do. Ulysses — like a bolt of thunder from the blue. Ulysses — always fighting all the evil forces bringing peace and justice to all.',
                'from_id' => 1,
                'to_id' => 2,
                'animal_id' => $animal2->id
            ],
            [
                'subject' => 'Milyen az egyénisége?',
                'message' => 'Ulysses, Ulysses — Soaring through all the galaxies. In search of Earth, flying in to the night. Ulysses, Ulysses — Fighting evil and tyranny, with all his power, and with all of his might. Ulysses — no-one else can do the things you do. Ulysses — like a bolt of thunder from the blue. Ulysses — always fighting all the evil forces bringing peace and justice to all.',
                'from_id' => 2,
                'to_id' => 3,
                'animal_id' => $animal3->id
            ],
            [
                'subject' => 'Harap?',
                'message' => 'Ulysses, Ulysses — Soaring through all the galaxies. In search of Earth, flying in to the night. Ulysses, Ulysses — Fighting evil and tyranny, with all his power, and with all of his might. Ulysses — no-one else can do the things you do. Ulysses — like a bolt of thunder from the blue. Ulysses — always fighting all the evil forces bringing peace and justice to all.',
                'from_id' => 4,
                'to_id' => 3,
                'animal_id' => $animal3->id
            ],
            [
                'subject' => 'Szobatiszta?',
                'message' => 'Ulysses, Ulysses — Soaring through all the galaxies. In search of Earth, flying in to the night. Ulysses, Ulysses — Fighting evil and tyranny, with all his power, and with all of his might. Ulysses — no-one else can do the things you do. Ulysses — like a bolt of thunder from the blue. Ulysses — always fighting all the evil forces bringing peace and justice to all.',
                'from_id' => 2,
                'to_id' => 3,
                'animal_id' => $animal3->id
            ],
            [
                'subject' => 'Ivartalanítva van-e?',
                'message' => 'Ulysses, Ulysses — Soaring through all the galaxies. In search of Earth, flying in to the night. Ulysses, Ulysses — Fighting evil and tyranny, with all his power, and with all of his might. Ulysses — no-one else can do the things you do. Ulysses — like a bolt of thunder from the blue. Ulysses — always fighting all the evil forces bringing peace and justice to all.',
                'from_id' => 1,
                'to_id' => 3,
                'animal_id' => $animal3->id
            ],
            [
                'subject' => 'Milyen tápot szokott enni?',
                'message' => 'Ulysses, Ulysses — Soaring through all the galaxies. In search of Earth, flying in to the night. Ulysses, Ulysses — Fighting evil and tyranny, with all his power, and with all of his might. Ulysses — no-one else can do the things you do. Ulysses — like a bolt of thunder from the blue. Ulysses — always fighting all the evil forces bringing peace and justice to all.',
                'from_id' => 1,
                'to_id' => 3,
                'animal_id' => $animal3->id
            ],
        ];

        foreach ($messages as $message) {
            Message::create(array(
                'subject' => $message['subject'],
                'message' => $message['message'],
                'from_id' => $message['from_id'],
                'to_id' => $message['to_id'],
                'animal_id' => $message['animal_id'],
            ));
        }
    }
}
