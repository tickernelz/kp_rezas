<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\SuratMasuk
 *
 * @property int $id
 * @property string $bidang
 * @property string $nomor_surat
 * @property string $tanggal_masuk
 * @property string $tanggal_surat
 * @property string $pengirim
 * @property string $kepada
 * @property string $perihal
 * @property string|null $file
 * @property string $operator
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|SuratMasuk newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SuratMasuk newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SuratMasuk query()
 * @method static \Illuminate\Database\Eloquent\Builder|SuratMasuk whereBidang($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SuratMasuk whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SuratMasuk whereFile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SuratMasuk whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SuratMasuk whereKepada($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SuratMasuk whereNomorSurat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SuratMasuk whereOperator($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SuratMasuk wherePengirim($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SuratMasuk wherePerihal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SuratMasuk whereTanggalMasuk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SuratMasuk whereTanggalSurat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SuratMasuk whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class SuratMasuk extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];
}
