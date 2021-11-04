<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\SuratKeluar
 *
 * @property int $id
 * @property string $kode
 * @property string $nomor_surat
 * @property string $tanggal_keluar
 * @property string $tanggal_surat
 * @property string $kepada
 * @property string $perihal
 * @property string|null $file
 * @property string $operator
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|SuratKeluar newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SuratKeluar newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SuratKeluar query()
 * @method static \Illuminate\Database\Eloquent\Builder|SuratKeluar whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SuratKeluar whereFile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SuratKeluar whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SuratKeluar whereKepada($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SuratKeluar whereKode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SuratKeluar whereNomorSurat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SuratKeluar whereOperator($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SuratKeluar wherePerihal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SuratKeluar whereTanggalKeluar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SuratKeluar whereTanggalSurat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SuratKeluar whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class SuratKeluar extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];
}
