@extends('layouts.template-web')
@section('body')
    <div class="w-full min-h-screen">
        <div class="max-w-screen-lg m-auto pb-5 border-2">
            <div class="bg-cover bg-center" style="background-image: url('{{ asset('images/building.JPG') }}')">
                <div class="relative w-full h-full backdrop-blur-sm bg-blue-500/30 flex items-center pb-5">
                    <img src="{{ asset('logo.png') }}" alt="logo" class="w-24 p-2 bg-white rounded-b-lg ml-2 shadow-xl">
                </div>
            </div>

            <form action="{{ route('web.store') }}" method="POST">

                @csrf

                <div class="grid grid-cols-1 py-5 gap-y-5">

                    <h1 class="text-center text-xl font-semibold underline">Formulaire D'inscription</h1>

                    <span class="w-full bg-green-600 text-white py-5 text-xl font-bold px-5">Le pére </span>

                    <div class="px-2 grid grid-cols-1 gap-y-5">
                        <x-forms.input-web type="date" name="deposition_date" required>
                            <x-slot:label_text>
                                Date de deposition du dossier
                            </x-slot:label_text>
                        </x-forms.input-web>
                        <div class="grid grid-cols-2 gap-5">

                            <x-forms.input-web type="text" name="lnamefather" required>
                                <x-slot:label_text>
                                    Nom*
                                </x-slot:label_text>
                            </x-forms.input-web>

                            <x-forms.input-web type="text" name="fnamefather" required>
                                <x-slot:label_text>
                                    Prénom*
                                </x-slot:label_text>
                            </x-forms.input-web>

                        </div>

                        <div class="grid grid-cols-2 gap-5">

                            <x-forms.input-web type="text" name="emailfather" required>
                                <x-slot:label_text>
                                    Email
                                </x-slot:label_text>
                            </x-forms.input-web>

                            <x-forms.input-web type="tel" name="numberfather" required>
                                <x-slot:label_text>
                                    Téléphone*
                                </x-slot:label_text>
                            </x-forms.input-web>

                            <x-forms.input-web type="tel" name="home_numfather" required>
                                <x-slot:label_text>
                                    Téléphone Domicile
                                </x-slot:label_text>
                            </x-forms.input-web>

                            <x-forms.input-web type="tel" name="whatsappfather" required>
                                <x-slot:label_text>
                                    Whatsapp
                                </x-slot:label_text>
                            </x-forms.input-web>

                        </div>

                        <x-forms.input-web type="text" name="addressfather" required>
                            <x-slot:label_text>
                                Adresse
                            </x-slot:label_text>
                        </x-forms.input-web>

                        <x-forms.input-web type="text" name="professionfather" required>
                            <x-slot:label_text>
                                Profession
                            </x-slot:label_text>
                        </x-forms.input-web>

                    </div>

                    <span class="w-full bg-cyan-500 text-white py-5 text-xl font-bold px-5">La Mére </span>

                    <div class="px-2 grid grid-cols-1 gap-y-5">


                        <div class="grid grid-cols-2 gap-5">

                            <x-forms.input-web type="text" name="lnamemother" required>
                                <x-slot:label_text>
                                    Nom*
                                </x-slot:label_text>
                            </x-forms.input-web>

                            <x-forms.input-web type="text" name="fnamemother" required>
                                <x-slot:label_text>
                                    Prénom*
                                </x-slot:label_text>
                            </x-forms.input-web>

                        </div>

                        <div class="grid grid-cols-2 gap-5">

                            <x-forms.input-web type="text" name="emailmother" required>
                                <x-slot:label_text>
                                    Email
                                </x-slot:label_text>
                            </x-forms.input-web>

                            <x-forms.input-web type="tel" name="numbermother" required>
                                <x-slot:label_text>
                                    Téléphone*
                                </x-slot:label_text>
                            </x-forms.input-web>

                            <x-forms.input-web type="tel" name="home_nummother" required>
                                <x-slot:label_text>
                                    Téléphone Domicile
                                </x-slot:label_text>
                            </x-forms.input-web>

                            <x-forms.input-web type="tel" name="whatsappmother" required>
                                <x-slot:label_text>
                                    Whatsapp
                                </x-slot:label_text>
                            </x-forms.input-web>

                        </div>


                        <x-forms.input-web type="text" name="addressmother" required>
                            <x-slot:label_text>
                                Adresse
                            </x-slot:label_text>
                        </x-forms.input-web>

                        <x-forms.input-web type="text" name="professionmother" required>
                            <x-slot:label_text>
                                Profession
                            </x-slot:label_text>
                        </x-forms.input-web>


                        <button type="submit"
                            class="bg-green-600 w-fit px-7 py-2 justify-self-end rounded-lg text-white text-xl shadow-green-500 shadow hover:shadow-lg hover:bg-green-700 shover:hadow-green-700 hover:-translate-y-2 transition-all duration-200">Suivant
                        </button>
                    </div>

            </form>
        </div>
    </div>
@endsection
