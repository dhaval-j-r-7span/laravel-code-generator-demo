<?php

namespace Dhaval\CodeGenerator\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Dhaval\CodeGenerator\Models\CodeGeneratorFileLog;

class Logs extends Component
{
    use WithPagination;

    public function render()
    {
        return view('code-generator::livewire.logs', [
            'logs' => CodeGeneratorFileLog::orderBy('created_at', 'desc')->paginate(10)
        ]);
    }
}