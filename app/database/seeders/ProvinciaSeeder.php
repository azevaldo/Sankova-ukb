<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Provincia;
class ProvinciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // Bengo
$bengo = Provincia::create([
    'provincia' => 'Bengo'
]);
$bengo->municipios()->createMany([
    ['municipio' => 'Ambriz'],
    ['municipio' => 'Bula Atumba'],
    ['municipio' => 'Dande'],
    ['municipio' => 'Dembos'],
    ['municipio' => 'Nambuangongo'],
    ['municipio' => 'Pango Aluquém'],
]);

// Benguela
$benguela = Provincia::create([
    'provincia' => 'Benguela'
]);
$benguela->municipios()->createMany([
    ['municipio' => 'Baía Farta'],
    ['municipio' => 'Balombo'],
    ['municipio' => 'Benguela'],
    ['municipio' => 'Bocoio'],
    ['municipio' => 'Caimbambo'],
    ['municipio' => 'Catumbela'],
    ['municipio' => 'Chongoroi'],
    ['municipio' => 'Cubal'],
    ['municipio' => 'Ganda'],
    ['municipio' => 'Lobito'],
]);

// Bié
$bie = Provincia::create([
    'provincia' => 'Bié'
]);
$bie->municipios()->createMany([
    ['municipio' => 'Andulo'],
    ['municipio' => 'Camacupa'],
    ['municipio' => 'Catabola'],
    ['municipio' => 'Chinguar'],
    ['municipio' => 'Chitembo'],
    ['municipio' => 'Cuemba'],
    ['municipio' => 'Cunhinga'],
    ['municipio' => 'Cuíto'],
    ['municipio' => 'Nharea'],
]);

// Cabinda
$cabinda = Provincia::create([
    'provincia' => 'Cabinda'
]);
$cabinda->municipios()->createMany([
    ['municipio' => 'Cabinda'],
    ['municipio' => 'Cacongo'],
    ['municipio' => 'Buco-Zau'],
    ['municipio' => 'Belize'],
]);

// Cuando Cubango
$cuandoCubango = Provincia::create([
    'provincia' => 'Cuando Cubango'
]);
$cuandoCubango->municipios()->createMany([
    ['municipio' => 'Calai'],
    ['municipio' => 'Cuangar'],
    ['municipio' => 'Cuchi'],
    ['municipio' => 'Cuito Cuanavale'],
    ['municipio' => 'Dirico'],
    ['municipio' => 'Mavinga'],
    ['municipio' => 'Menongue'],
    ['municipio' => 'Nancova'],
    ['municipio' => 'Rivungo'],
]);
// Cuanza Norte
$cuanzaNorte = Provincia::create(['provincia' => 'Cuanza Norte']);
$cuanzaNorte->municipios()->createMany([
    ['municipio' => 'Ambaca'],
    ['municipio' => 'Banga'],
    ['municipio' => 'Bolongongo'],
    ['municipio' => 'Cambembe'],
    ['municipio' => 'Cazengo'],
    ['municipio' => 'Golungo Alto'],
    ['municipio' => 'Gonguembo'],
    ['municipio' => 'Lucala'],
    ['municipio' => 'Quiculungo'],
    ['municipio' => 'Samba Cajú'],
]);

// Cuanza Sul
$cuanzaSul = Provincia::create(['provincia' => 'Cuanza Sul']);
$cuanzaSul->municipios()->createMany([
    ['municipio' => 'Gabela'],
    ['municipio' => 'Cassongue'],
    ['municipio' => 'Cela'],
    ['municipio' => 'Conda'],
    ['municipio' => 'Ebo'],
    ['municipio' => 'Libolo'],
    ['municipio' => 'Mussende'],
    ['municipio' => 'Porto Amboim'],
    ['municipio' => 'Quilenda'],
    ['municipio' => 'Quibala'],
    ['municipio' => 'Seles'],
    ['municipio' => 'Sumbe'],
]);

// Cunene
$cunene = Provincia::create(['provincia' => 'Cunene']);
$cunene->municipios()->createMany([
    ['municipio' => 'Cahama'],
    ['municipio' => 'Cuanhama'],
    ['municipio' => 'Curoca'],
    ['municipio' => 'Cuvelai'],
    ['municipio' => 'Namacunde'],
    ['municipio' => 'Ombadja'],
]);

// Huambo
$huambo = Provincia::create(['provincia' => 'Huambo']);
$huambo->municipios()->createMany([
    ['municipio' => 'Longonjo'],
    ['municipio' => 'Bailundo'],
    ['municipio' => 'Chicala Choloanga'],
    ['municipio' => 'Mungo'],
    ['municipio' => 'Londuimbale'],
    ['municipio' => 'Tchindjendje'],
    ['municipio' => 'Ucuma'],
    ['municipio' => 'Cachiumgo'],
    ['municipio' => 'Caála'],
    ['municipio' => 'Ecunha'],
    ['municipio' => 'Huambo'],
]);

// Huila
$huila = Provincia::create(['provincia' => 'Huíla']);
$huila->municipios()->createMany([
    ['municipio' => 'Caconda'],
    ['municipio' => 'Cacula'],
    ['municipio' => 'Caluquembe'],
    ['municipio' => 'Gambos'],
    ['municipio' => 'Chibia'],
    ['municipio' => 'Chicomba'],
    ['municipio' => 'Chipindo'],
    ['municipio' => 'Cuvango'],
    ['municipio' => 'Humpata'],
    ['municipio' => 'Jamba'],
    ['municipio' => 'Lubango'],
    ['municipio' => 'Matala'],
    ['municipio' => 'Quilengues'],
    ['municipio' => 'Quipungo'],
]);

// Luanda
$luanda = Provincia::create(['provincia' => 'Luanda']);
$luanda->municipios()->createMany([
    ['municipio' => 'Icolo-e-Bengo'],
    ['municipio' => 'Luanda'],
    ['municipio' => 'Quiçama'],
    ['municipio' => 'Cacuaco'],
    ['municipio' => 'Cazenga'],
    ['municipio' => 'Viana'],
    ['municipio' => 'Belas'],
    ['municipio' => 'Kilamba Kiaxi'],
    ['municipio' => 'Talatona'],
]);

// Lunda Norte
$lundaNorte = Provincia::create(['provincia' => 'Lunda Norte']);
$lundaNorte->municipios()->createMany([
    ['municipio' => 'Cambulo'],
    ['municipio' => 'Capenda Camulemba'],
    ['municipio' => 'Caungula'],
    ['municipio' => 'Chitato'],
    ['municipio' => 'Cuango'],
    ['municipio' => 'Cuílo'],
    ['municipio' => 'Lubalo'],
    ['municipio' => 'Lucapa'],
    ['municipio' => 'Lóvua'],
    ['municipio' => 'Xá-Muteba'],
]);

// Lunda Sul
$lundaSul = Provincia::create(['provincia' => 'Lunda Sul']);
$lundaSul->municipios()->createMany([
    ['municipio' => 'Cacolo'],
    ['municipio' => 'Dala'],
    ['municipio' => 'Muconda'],
    ['municipio' => 'Saurimo'],
]);

// Malanje
$malanje = Provincia::create(['provincia' => 'Malanje']);
$malanje->municipios()->createMany([
    ['municipio' => 'Cacuso'],
    ['municipio' => 'Caombo'],
    ['municipio' => 'Calandula'],
    ['municipio' => 'Cambundi-Catembo'],
    ['municipio' => 'Cangandala'],
    ['municipio' => 'Cauba Nzogo'],
    ['municipio' => 'Cunda-Dia-Baze'],
    ['municipio' => 'Lumquembo'],
    ['municipio' => 'Malanje'],
    ['municipio' => 'Marimba'],
    ['municipio' => 'Massango'],
    ['municipio' => 'Mucari'],
    ['municipio' => 'Quela'],
    ['municipio' => 'Quirima'],
]);

// Moxico
$moxico = Provincia::create(['provincia' => 'Moxico']);
$moxico->municipios()->createMany([
    ['municipio' => 'Alto Zambeze'],
    ['municipio' => 'Bundas'],
    ['municipio' => 'Camanongue'],
    ['municipio' => 'Cameia'],
]);


// Namibe
$namibe = Provincia::create([
    'provincia' => 'Namibe',
]);
$namibe->municipios()->createMany([
    ['municipio' => 'Bibala'],
    ['municipio' => 'Camucuio'],
    ['municipio' => 'Moçâmedes'],
    ['municipio' => 'Tômbwa'],
    ['municipio' => 'Virei'],
]);

// Uíge
$uige = Provincia::create([
    'provincia' => 'Uíge',
]);
$uige->municipios()->createMany([
    ['municipio' => 'Alto Cauale'],
    ['municipio' => 'Ambuíla'],
    ['municipio' => 'Bembe'],
    ['municipio' => 'Buengas'],
    ['municipio' => 'Bungo'],
    ['municipio' => 'Damba'],
    ['municipio' => 'Macocola'],
    ['municipio' => 'Mucaba'],
    ['municipio' => 'Negage'],
    ['municipio' => 'Puri'],
    ['municipio' => 'Quimbele'],
    ['municipio' => 'Quitexe'],
    ['municipio' => 'Sanza Pombo'],
    ['municipio' => 'Songo'],
    ['municipio' => 'Uíge'],
    ['municipio' => 'Zombo'],
]);

// Zaire
$zaire = Provincia::create([
    'provincia' => 'Zaire',
]);
$zaire->municipios()->createMany([
    ['municipio' => 'Cuimba'],
    ['municipio' => 'Mabanza Congo'],
    ['municipio' => 'Nóqui'],
    ['municipio' => 'Soyo'],
    ['municipio' => 'Tomboco'],
]);

    }
}
