<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Skmengajar;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class SkmengajarCrud extends Component
{
    use WithPagination, WithFileUploads;

    public string $prodi = '', $semester = '', $tanggal = '';
    public $file;
    public ?int $skId = null;
    public bool $isEdit = false;
    public string $search = '';

    protected $paginationTheme = 'bootstrap';

    protected function rules()
    {
        return [
            'prodi' => 'required|max:30',
            'semester' => 'required|max:30',
            'tanggal' => 'required|date',
            'file' => 'nullable|file|max:5120',
        ];
    }

    public function render()
    {
        $query = Skmengajar::query();

        if ($this->search) {
            $query->where('prodi', 'like', "%{$this->search}%")
                  ->orWhere('semester', 'like', "%{$this->search}%");
        }

        return view('livewire.skmengajar-crud', [
            'data' => $query->latest()->paginate(5),
        ])->layout('layouts.app');
    }

    public function store()
    {
        $this->validate();
        $path = $this->file ? $this->file->store('sk-file', 'public') : null;

        Skmengajar::create([
            'prodi' => $this->prodi,
            'semester' => $this->semester,
            'tanggal' => $this->tanggal,
            'file' => $path,
        ]);

        $this->resetInput();
    }

    public function edit(int $id)
    {
        $item = Skmengajar::findOrFail($id);
        $this->skId = $item->id;
        $this->prodi = $item->prodi;
        $this->semester = $item->semester;
        $this->tanggal = $item->tanggal;
        $this->isEdit = true;
    }

    public function update()
    {
        $this->validate();

        $item = Skmengajar::findOrFail($this->skId);

        if ($this->file && $item->file && Storage::disk('public')->exists($item->file)) {
            Storage::disk('public')->delete($item->file);
        }

        $path = $this->file ? $this->file->store('sk-file', 'public') : $item->file;

        $item->update([
            'prodi' => $this->prodi,
            'semester' => $this->semester,
            'tanggal' => $this->tanggal,
            'file' => $path,
        ]);

        $this->resetInput();
    }

    public function delete(int $id)
    {
        $item = Skmengajar::findOrFail($id);
        if ($item->file && Storage::disk('public')->exists($item->file)) {
            Storage::disk('public')->delete($item->file);
        }
        $item->delete();
    }

    public function resetInput()
    {
        $this->prodi = '';
        $this->semester = '';
        $this->tanggal = '';
        $this->file = null;
        $this->skId = null;
        $this->isEdit = false;
    }
}
