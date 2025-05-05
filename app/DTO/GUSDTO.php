<?php

namespace App\DTO;

class GUSDTO
{
    public function __construct(
        public string $name,
        public string $regon,
        public string $nip,
        public string $krs,
        public ?string $voivodeship,
        public ?string $district,
        public ?string $commune,
        public ?string $city,
        public ?string $street,
        public ?string $buildingNumber,
        public ?string $apartmentNumber,
        public ?string $postalCode,
        public ?string $phone,
        public ?string $fax,
        public ?string $email,
        public ?string $website,
        public ?string $legalForm,
        public ?string $specificLegalForm,
        public ?string $financingForm,
        public ?string $ownershipForm,
        public ?string $registeringAuthority,
        public ?string $registerType
    ) {}

    public static function gusParserCreate(array $data): self
    {
        return new self(
            name: $data['praw_nazwa'],
            regon: $data['praw_regon9'],
            nip: $data['praw_nip'],
            krs: $data['praw_numerWRejestrzeEwidencji'],
            voivodeship: $data['praw_adSiedzWojewodztwo_Nazwa'],
            district: $data['praw_adSiedzPowiat_Nazwa'],
            commune: $data['praw_adSiedzGmina_Nazwa'],
            city: $data['praw_adSiedzMiejscowosc_Nazwa'],
            street: $data['praw_adSiedzUlica_Nazwa'],
            buildingNumber: $data['praw_adSiedzNumerNieruchomosci'],
            apartmentNumber: $data['praw_adSiedzNumerLokalu'],
            postalCode: $data['praw_adSiedzKodPocztowy'],
            phone: $data['praw_numerTelefonu'],
            fax: $data['praw_numerFaksu'],
            email: $data['praw_adresEmail'],
            website: $data['praw_adresStronyinternetowej'],
            legalForm: $data['praw_podstawowaFormaPrawna_Nazwa'],
            specificLegalForm: $data['praw_szczegolnaFormaPrawna_Nazwa'],
            financingForm: $data['praw_formaFinansowania_Nazwa'],
            ownershipForm: $data['praw_formaWlasnosci_Nazwa'],
            registeringAuthority: $data['praw_organRejestrowy_Nazwa'],
            registerType: $data['praw_rodzajRejestruEwidencji_Nazwa'],
        );
    }

}
