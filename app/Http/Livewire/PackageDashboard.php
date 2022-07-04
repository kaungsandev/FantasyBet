<?php

namespace App\Http\Livewire;

use App\Models\Packages;
use Livewire\Component;

class PackageDashboard extends Component
{
    public $name;

    public $amount;

    public $duration;

    public $package_id = null;

    public $edit_mode = false;

    public $auto_sub = false;

    protected $rules = [
        'name' =>'required|string|min:5',
        'amount' =>'required|integer|min:100',
        'duration' =>'required|integer|min:1',
        'auto_sub' =>'required|boolean|min:0|max:1',
    ];

    protected $listeners = [
        'PackageCreated' => 'render',
    ];

    public function render()
    {
        return view('livewire.package-dashboard', [
            'packages' => Packages::all(),
        ]);
    }

    public function createPackage()
    {
        $this->validate();

        Packages::updateOrCreate(
            [
                'id' => $this->package_id,
            ], [
                'name' => $this->name,
                'amount' => $this->amount,
                'duration' => $this->duration,
                'auto_sub' => $this->auto_sub,
            ]);
        $this->resetData();
        $this->emit('PackageCreated');
    }

    public function editPackage(Packages $package)
    {
        $this->edit_mode = true;
        $this->package_id = $package->id;
        $this->name = $package->name;
        $this->amount = $package->amount;
        $this->duration = $package->duration;
        $this->auto_sub = $package->auto_sub;
    }

    public function resetData()
    {
        $this->package_id = null;
        $this->name = null;
        $this->amount = null;
        $this->duration = null;
        $this->auto_sub = false;
        $this->edit_mode = false;
    }
}
