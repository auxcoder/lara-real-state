<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string|null $name
 * @property string|null $email
 * @property string|null $phone_number
 * @property string|null $trade_license
 * @property string|null $emirates_id
 * @property string|null $passport
 * @property string|null $bank_account_no
 * @property string|null $iban_letter
 * @property string|null $vat_registration_no
 * @property string|null $contact_person_name
 * @property string|null $office_address
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Information newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Information newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Information query()
 * @method static \Illuminate\Database\Eloquent\Builder|Information whereBankAccountNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Information whereContactPersonName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Information whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Information whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Information whereEmiratesId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Information whereIbanLetter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Information whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Information whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Information whereOfficeAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Information wherePassport($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Information wherePhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Information whereTradeLicense($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Information whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Information whereVatRegistrationNo($value)
 * @mixin \Eloquent
 */
class Information extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'phone_number', 'trade_license',
        'emirates_id', 'passport', 'bank_account_no',
        'iban_letter', 'vat_registration_no', 'contact_person_name',
        'office_address',
    ];
}
