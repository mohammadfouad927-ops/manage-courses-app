<?php

namespace App;

enum PaymentStatus: string
{
    case Failed = 'failed';
    case Pending = 'pending';
    case PartiallyPaid = 'partially_paid';
    case Paid = 'paid';

    public function label(): string
    {
        return match($this){
            self::PartiallyPaid => 'Partially Paid',
            default => ucfirst($this->value)
        };
    }

    public function class():string
    {
        return match($this){
            self::Failed => 'badge-danger',
            self::Pending => 'badge-warning',
            self::PartiallyPaid => 'badge-info text-white',
            self::Paid => 'badge-success',
        };
    }
}
