<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    /**
     * Summary of fillable
     * @var array
     *
     * O atributo $fillable é utilizado para definir quais campos de um modelo podem ser atribuídos em massa (mass assignment).
     * Isso é importante para proteger seu aplicativo contra ataques de atribuição em massa,
     * onde um usuário mal-intencionado pode tentar definir campos que não deveriam ser alteráveis.
     */
    protected $fillable = [
        "title",
        "description",
        "long_description",
    ];

    /**
     * Summary of guarded
     * @var array
     *
     * É o oposto do atributo $fillable. O atributo $guarded é utilizado para definir quais campos de um modelo não podem ser atribuídos em massa.
     * É mais seguro utilizar o $fillable para não modificar acidentalmente atributos que não devem ser alterados.
     *
     */
    protected $guarded = ["id"];

    // public function getRouteKeyName() {
    //     return 'slug';
    // }

    public function toggleComplete() {
        $this->completed = !$this->completed;
        $this->save();
    }
}
