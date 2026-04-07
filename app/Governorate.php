<?php

namespace App;

enum Governorate: string {
    case Cairo = 'cairo';
    case Giza = 'giza';
    case Alexandria = 'alexandria';
    case Dakahlia = 'dakahlia';
    case RedSea = 'red_sea';
    case Beheira = 'beheira';
    case Fayoum = 'fayoum';
    case Gharbia = 'gharbia';
    case Ismailia = 'ismailia';
    case Menofia = 'menofia';
    case Minya = 'minya';
    case Qalyubia = 'qalyubia';
    case NewValley = 'new_valley';
    case Sharqia = 'sharqia';
    case Suez = 'suez';
    case Aswan = 'aswan';
    case Assiut = 'assiut';
    case BeniSuef = 'beni_suef';
    case PortSaid = 'port_said';
    case Damietta = 'damietta';
    case Sharkia = 'sharkia';
    case SouthSinai = 'south_sinai';
    case NorthSinai = 'north_sinai';
    case KafrElSheikh = 'kafr_el_sheikh';
    case Matrouh = 'matrouh';
    case Luxor = 'luxor';
    case Qena = 'qena';
    case Sohag = 'sohag';

    // Helper to get human-readable names for your dropdown
    public function label(): string {
        return match($this) {
            self::RedSea => 'Red Sea',
            self::NewValley => 'New Valley',
            self::BeniSuef => 'Beni Suef',
            self::PortSaid => 'Port Said',
            self::SouthSinai => 'South Sinai',
            self::NorthSinai => 'North Sinai',
            self::KafrElSheikh => 'Kafr El Sheikh',
            default => ucfirst($this->value),
        };
    }
}

