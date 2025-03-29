<div>
    <flux:modal.trigger name="create-forum-reply">
        <flux:button class="mb-2 cursor-pointer">Ajouter une réponse</flux:button>
    </flux:modal.trigger>

    <flux:modal name="create-forum-reply" class="md:w-96">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Ajouter une réponse</flux:heading>
                <flux:text class="mt-2">Remplissez le formulaire ci-dessous pour créer une nouvelle réponse 📜
                </flux:text>
            </div>

            <flux:textarea label="Contenu" wire:model="content" required="true"/>

            <div class="flex">
                <flux:spacer/>
                <flux:button type="submit" wire:click="createForumReply" variant="primary">Créer</flux:button>
            </div>
        </div>
    </flux:modal>
</div>
