namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price', 'image', 'sizes']; // Tambahkan 'sizes'

    protected $casts = [
        'sizes' => 'array', // Cast 'sizes' sebagai array
    ];
}