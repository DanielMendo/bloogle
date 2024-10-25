<?php

namespace App\Filament\Resources\UserResource\Pages;

use Filament\Actions;
use Illuminate\Support\Facades\Hash;
use App\Filament\Resources\UserResource;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Verificamos si la contraseña fue proporcionada
        if (empty($data['password'])) {
            // Si la contraseña está vacía, no la incluimos en los datos a guardar
            unset($data['password']);
        } else {
            // Si se proporciona una nueva contraseña, la encriptamos
            $data['password'] = Hash::make($data['password']);
        }

        return $data;
    }
}
