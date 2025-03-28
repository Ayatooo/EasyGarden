@php use App\Models\ForumPost; @endphp
<div>
    <flux:modal.trigger name="create-forum-post">
        <flux:button>Ajouter un post</flux:button>
    </flux:modal.trigger>

    <flux:modal name="create-forum-post" class="md:w-96">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Ajouter un post</flux:heading>
                <flux:text class="mt-2">Remplissez le formulaire ci-dessous pour créer un nouveau post 📜</flux:text>
            </div>

            <flux:select label="Catégorie" wire:model="category" required="true">
                <option value="">Choisissez une catégorie</option>
                @foreach(ForumPost::CATEGORIES as $category)
                    <option value="{{ $category }}">{{ $category }}</option>
                @endforeach
            </flux:select>

            <flux:input type="text" label="Titre" wire:model="title" required="true"/>

            <flux:textarea label="Contenu" wire:model="content" required="true"/>
            <div class="flex">
                <flux:spacer/>

                <flux:button type="submit" wire:click="createForumPost" variant="primary">Créer</flux:button>
            </div>
        </div>
    </flux:modal>
</div>
