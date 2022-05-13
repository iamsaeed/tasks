<?php

namespace App\Models;

use App\Traits\Common;
use App\Traits\Search;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class App extends Model
{
    use HasFactory, Search, Common;
}
