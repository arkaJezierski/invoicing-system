<?php

namespace App\Data;

use App\Data\Casts\EmptyStringToNullCast;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Attributes\Validation\Nullable;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Data;

class GUSData extends Data
{
    public function __construct(
        #[Required, MapInputName('praw_nazwa')]
        public string $name,

        #[Required, MapInputName('praw_regon9')]
        public string $regon,

        #[Required, MapInputName('praw_nip')]
        public string $nip,

        #[Required, MapInputName('praw_numerWRejestrzeEwidencji')]
        public string $krs,

        #[Nullable, MapInputName('praw_adSiedzWojewodztwo_Nazwa'), WithCast(EmptyStringToNullCast::class)]
        public ?string $voivodeship,

        #[Nullable, MapInputName('praw_adSiedzPowiat_Nazwa'), WithCast(EmptyStringToNullCast::class)]
        public ?string $district,

        #[Nullable, MapInputName('praw_adSiedzGmina_Nazwa'), WithCast(EmptyStringToNullCast::class)]
        public ?string $commune,

        #[Nullable, MapInputName('praw_adSiedzMiejscowosc_Nazwa'), WithCast(EmptyStringToNullCast::class)]
        public ?string $city,

        #[Nullable, MapInputName('praw_adSiedzUlica_Nazwa'), WithCast(EmptyStringToNullCast::class)]
        public ?string $street,

        #[Nullable, MapInputName('praw_adSiedzNumerNieruchomosci'), WithCast(EmptyStringToNullCast::class)]
        public ?string $buildingNumber,

        #[Nullable, MapInputName('praw_adSiedzNumerLokalu'), WithCast(EmptyStringToNullCast::class)]
        public ?string $apartmentNumber,

        #[Nullable, MapInputName('praw_adSiedzKodPocztowy'), WithCast(EmptyStringToNullCast::class)]
        public ?string $postalCode,

        #[Nullable, MapInputName('praw_numerTelefonu'), WithCast(EmptyStringToNullCast::class)]
        public ?string $phone,

        #[Nullable, MapInputName('praw_numerFaksu'), WithCast(EmptyStringToNullCast::class)]
        public ?string $fax,

        #[Nullable, MapInputName('praw_adresEmail'), WithCast(EmptyStringToNullCast::class)]
        public ?string $email,

        #[Nullable, MapInputName('praw_adresStronyinternetowej'), WithCast(EmptyStringToNullCast::class)]
        public ?string $website,

        #[Nullable, MapInputName('praw_podstawowaFormaPrawna_Nazwa'), WithCast(EmptyStringToNullCast::class)]
        public ?string $legalForm,

        #[Nullable, MapInputName('praw_szczegolnaFormaPrawna_Nazwa'), WithCast(EmptyStringToNullCast::class)]
        public ?string $specificLegalForm,

        #[Nullable, MapInputName('praw_formaFinansowania_Nazwa'), WithCast(EmptyStringToNullCast::class)]
        public ?string $financingForm,

        #[Nullable, MapInputName('praw_formaWlasnosci_Nazwa'), WithCast(EmptyStringToNullCast::class)]
        public ?string $ownershipForm,

        #[Nullable, MapInputName('praw_organRejestrowy_Nazwa'), WithCast(EmptyStringToNullCast::class)]
        public ?string $registeringAuthority,

        #[Nullable, MapInputName('praw_rodzajRejestruEwidencji_Nazwa'), WithCast(EmptyStringToNullCast::class)]
        public ?string $registerType,
    ) {}
}
