<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $phone_number
 * @property string $nationality
 * @property string|null $property_type
 * @property string|null $specifications
 * @property string|null $preferred_location
 * @property string|null $budget_range
 * @property string $payment_for_rent
 * @property int|null $number_of_family_members
 * @property string $passport_pdf
 * @property string $emirates_id_pdf
 * @property string $bank_statement_pdf
 * @property string|null $trade_license_pdf
 * @property string|null $vat_registration_certificate_pdf
 * @property string|null $etihad_credit_bureau_pdf
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|VisitorSubmission newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VisitorSubmission newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VisitorSubmission query()
 * @method static \Illuminate\Database\Eloquent\Builder|VisitorSubmission whereBankStatementPdf($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitorSubmission whereBudgetRange($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitorSubmission whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitorSubmission whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitorSubmission whereEmiratesIdPdf($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitorSubmission whereEtihadCreditBureauPdf($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitorSubmission whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitorSubmission whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitorSubmission whereNationality($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitorSubmission whereNumberOfFamilyMembers($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitorSubmission wherePassportPdf($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitorSubmission wherePaymentForRent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitorSubmission wherePhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitorSubmission wherePreferredLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitorSubmission wherePropertyType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitorSubmission whereSpecifications($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitorSubmission whereTradeLicensePdf($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitorSubmission whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VisitorSubmission whereVatRegistrationCertificatePdf($value)
 * @mixin \Eloquent
 */
class VisitorSubmission extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'nationality',
        'property_type',
        'specifications',
        'preferred_location',
        'budget_range',
        'payment_for_rent',
        'number_of_family_members',
        'passport_pdf',
        'emirates_id_pdf',
        'bank_statement_pdf',
        'trade_license_pdf',
        'vat_registration_certificate_pdf',
        'etihad_credit_bureau_pdf',
    ];
}
