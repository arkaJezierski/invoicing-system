<?php

namespace Database\Seeders;

use App\Models\ClientIdentifierType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClientIdentifierTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ClientIdentifierType::insert([
            ['id' => 1, 'country_id' => 228, 'name' => 'Numer Identyfikacji Podatkowej', 'short_name' => 'NIP', 'format' => '/^\d{10}$|^\d{3}-\d{3}-\d{2}-\d{2}$/i', 'is_primary' => true, 'verification_website' => 'https://wyszukiwarkaregon.stat.gov.pl/'],
            ['id' => 2, 'country_id' => 228, 'name' => 'REGON', 'short_name' => 'REGON', 'format' => '/^\d{10}$|^\d{3}-\d{3}-\d{2}-\d{2}$/i', 'is_primary' => false, 'verification_website' => 'https://wyszukiwarkaregon.stat.gov.pl/'],
            ['id' => 3, 'country_id' => 228, 'name' => 'Krajowy Rejestr Sądowy', 'short_name' => 'KRS', 'format' => '/^\d{10}$|^\d{3}-\d{3}-\d{2}-\d{2}$/i', 'is_primary' => false, 'verification_website' => 'https://wyszukiwarkaregon.stat.gov.pl/'],
            ['id' => 4, 'country_id' => 96, 'name' => 'Umsatzsteuer-Identifikationsnummer', 'short_name' => 'USt-IdNr.', 'format' => '/^DE[0-9]{9}$/i', 'is_primary' => true, 'verification_website' => 'https://evatr.bff-online.de/eVatR/'],
            ['id' => 5, 'country_id' => 23, 'name' => 'Numéro de TVA intracommunautaire', 'short_name' => 'TVA', 'format' => '/^FR[A-Z0-9]{2}[0-9]{9}$/i', 'is_primary' => true, 'verification_website' => 'https://www.insee.fr/'],
            ['id' => 6, 'country_id' => 12, 'name' => 'Partita IVA', 'short_name' => 'IVA', 'format' => '/^IT[0-9]{11}$/i', 'is_primary' => true, 'verification_website' => 'https://www.agenziaentrate.gov.it/'],
            ['id' => 7, 'country_id' => 112, 'name' => 'Número de Identificación Fiscal', 'short_name' => 'NIF', 'format' => '/^[A-Z0-9]{1,9}$/i', 'is_primary' => true, 'verification_website' => 'https://www.agenciatributaria.es/'],
            ['id' => 8, 'country_id' => 48, 'name' => 'Value Added Tax Registration Number', 'short_name' => 'VAT', 'format' => '/^GB[0-9]{9}$|^GB[0-9]{12}$/i', 'is_primary' => true, 'verification_website' => 'https://www.gov.uk/check-uk-vat-number'],
            ['id' => 9, 'country_id' => 67, 'name' => 'BTW-nummer', 'short_name' => 'BTW', 'format' => '/^NL[0-9]{9}B[0-9]{2}$/i', 'is_primary' => true, 'verification_website' => 'https://www.belastingdienst.nl/'],
            ['id' => 10, 'country_id' => 243, 'name' => 'Numéro d’entreprise', 'short_name' => 'BE VAT', 'format' => '/^BE0[0-9]{9}$/i', 'is_primary' => true, 'verification_website' => 'https://kbopub.economie.fgov.be/'],
            ['id' => 11, 'country_id' => 169, 'name' => 'UID-Nummer', 'short_name' => 'UID', 'format' => '/^ATU[0-9]{8}$/i', 'is_primary' => true, 'verification_website' => 'https://www.bmf.gv.at/'],
            ['id' => 12, 'country_id' => 100, 'name' => 'Organisationsnummer', 'short_name' => 'VAT SE', 'format' => '/^SE[0-9]{12}$/i', 'is_primary' => true, 'verification_website' => 'https://www.skatteverket.se/'],
            ['id' => 13, 'country_id' => 90, 'name' => 'Індивідуальний податковий номер', 'short_name' => 'IPN', 'format' => '/^\d{10}$/i', 'is_primary' => true, 'verification_website' => 'https://tax.gov.ua/'],
            ['id' => 14, 'country_id' => 90, 'name' => 'Код ЄДРПОУ', 'short_name' => 'EDRPOU', 'format' => '/^\d{8}$/i', 'is_primary' => true, 'verification_website' => 'https://usr.minjust.gov.ua/'],
        ]);
    }
}
