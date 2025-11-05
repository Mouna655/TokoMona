<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateProduct extends CreateRecord
{
    protected static string $resource = ProductResource::class;

    protected function getFormActions(): array
    {
        return [
            parent::getCreateFormAction()
            ->label('Simpan')
            ->color('success')
            ->icon('heroicon-o-check-circle')
        ];
    }
}
