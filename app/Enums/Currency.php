<?php

namespace App\Enums;

use App\Traits\HasEnumTranslations;

enum Currency: string
{
    case XOF = 'XOF'; // Franc CFA BCEAO
    case EUR = 'EUR'; // Euro
    case USD = 'USD'; // Dollar américain
    case GBP = 'GBP'; // Livre sterling
    case CAD = 'CAD'; // Dollar canadien
    case NGN = 'NGN'; // Naira nigérian
    case GHS = 'GHS'; // Cedi ghanéen
    case MAD = 'MAD'; // Dirham marocain
    case ZAR = 'ZAR'; // Rand sud-africain

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public function symbol(): string
    {
        return match($this) {
            self::XOF => 'FCFA',
            self::EUR => '€',
            self::USD => '$',
            self::GBP => '£',
            self::CAD => 'C$',
            self::NGN => '₦',
            self::GHS => '₵',
            self::MAD => 'DH',
            self::ZAR => 'R',
        };
    }

    use HasEnumTranslations;
    
    public function label(): string
    {
        return match($this) {
            self::XOF => 'Franc CFA',
            self::EUR => 'Euro',
            self::USD => 'Dollar américain',
            self::GBP => 'Livre sterling',
            self::CAD => 'Dollar canadien',
            self::NGN => 'Naira nigérian',
            self::GHS => 'Cedi ghanéen',
            self::MAD => 'Dirham marocain',
            self::ZAR => 'Rand sud-africain',
        };
    }
    
    /**
     * Récupère les traductions disponibles pour cette devise
     */
    public function translations(): array
    {
        return match($this) {
            self::XOF => [
                'fr' => 'Franc CFA',
                'en' => 'CFA Franc',
            ],
            self::EUR => [
                'fr' => 'Euro',
                'en' => 'Euro',
            ],
            self::USD => [
                'fr' => 'Dollar américain',
                'en' => 'US Dollar',
            ],
            self::GBP => [
                'fr' => 'Livre sterling',
                'en' => 'British Pound',
            ],
            self::CAD => [
                'fr' => 'Dollar canadien',
                'en' => 'Canadian Dollar',
            ],
            self::NGN => [
                'fr' => 'Naira nigérian',
                'en' => 'Nigerian Naira',
            ],
            self::GHS => [
                'fr' => 'Cedi ghanéen',
                'en' => 'Ghanaian Cedi',
            ],
            self::MAD => [
                'fr' => 'Dirham marocain',
                'en' => 'Moroccan Dirham',
            ],
            self::ZAR => [
                'fr' => 'Rand sud-africain',
                'en' => 'South African Rand',
            ],
        };
    }
    
    public function icon(): string
    {
        return match($this) {
            self::XOF => 'heroicon-o-banknotes',
            self::EUR => 'heroicon-o-currency-euro',
            self::USD => 'heroicon-o-currency-dollar',
            self::GBP => 'heroicon-o-currency-pound',
            self::CAD => 'heroicon-o-currency-dollar',
            self::NGN => 'heroicon-o-banknotes',
            self::GHS => 'heroicon-o-banknotes',
            self::MAD => 'heroicon-o-banknotes',
            self::ZAR => 'heroicon-o-banknotes',
        };
    }
}
