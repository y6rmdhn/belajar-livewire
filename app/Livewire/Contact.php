<?php

namespace App\Livewire;

use App\Livewire\Forms\ContactForm;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Contact Page')]
class Contact extends Component
{
    public ContactForm $form;

    public function createNewMessage()
    {
        $this->form->store();

        session()->flash('success', 'Pesan berhasil dikirim!');
    }

    public function render()
    {
        return view('livewire.contact');
    }
}
