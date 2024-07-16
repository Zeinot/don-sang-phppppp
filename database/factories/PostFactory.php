<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Post::class;

    public function definition(): array
    {
        $types = ["Blood", "Plasma", "Platelets"];
        $cities = [
            "Marrakech", "Oued Zem", "Tangier", "Sidi Slimane", "Errachidia", "Guercif", "Oulad Teïma", "Ben Guerir", "Sale", "Sefrou", "Fnidq", "Sidi Qacem", "Tiznit", "Moulay Abdallah", "Youssoufia", "Martil", "Aïn Harrouda", "Souq Sebt Oulad Nemma", "Skhirate", "Ouezzane", "Sidi Yahya Zaer", "Rabat", "Al Hoceïma", "M’diq", "Midalt", "Azrou", "Meknès", "El Kelaa des Srarhna", "Ain El Aouda", "Oujda-Angad", "Beni Yakhlef", "Ad Darwa", "Al Aaroui", "Qasbat Tadla", "Boujad", "Jerada", "Kenitra", "Mrirt", "Agadir", "El Aïoun", "Azemmour", "Temsia", "Zagora", "Ait Ourir", "Aziylal", "Tétouan", "Sidi Yahia El Gharb", "Biougra", "Zaïo", "Aguelmous", "El Hajeb", "Casablanca", "Zeghanghane", "Imzouren", "Tit Mellil", "Taourirt", "Mechraa Bel Ksiri", "Temara", "Safi", "Al ’Attawia", "Tifariti", "Demnat", "Arfoud", "Tameslouht", "Bou Arfa", "Sidi Smai’il", "Souk et Tnine Jorf el Mellah", "Mehdya", "Aïn Taoujdat", "Chichaoua", "Tahla", "Oulad Yaïch", "Moulay Bousselham", "Iheddadene", "Missour", "Zawyat ech Cheïkh", "Bouknadel", "Oulad Tayeb", "Oulad Barhil", "Bir Jdid", "Khénifra", "El Jadid", "Laâyoune", "Mohammedia", "Kouribga", "Béni Mellal", "Ait Melloul", "Nador", "Taza", "Settat", "Berrechid", "Al Khmissat", "Inezgane", "Ksar El Kebir", "My Drarga", "Larache", "Guelmim", "Fès", "Berkane", "Ad Dakhla", "Bouskoura", "Al Fqih Ben Salah"
        ];

        return [
            "address" => $this->faker->address(),
            "eligibility_criteria" => $this->faker->realTextBetween(50, 700),
            "available_seats" => $this->faker->numberBetween(1, 50),
            "date" => $this->faker->dateTimeBetween(now(), now()->addYear()),
            'types' => $this->faker->randomElements($types, 2), // Returns an array of 2 random elements from $types
            'city' => $this->faker->randomElement($cities), // Returns an array of 2 random elements from $types
            "user_id" => $this->faker->numberBetween(1, 10),
        ];
    }
}
