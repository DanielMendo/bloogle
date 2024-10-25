<div>
    <form id="commentForm" wire:submit.prevent="comment">
        <div class="mb-3">
            <textarea class="form-control" id="commentContent" wire:model="content" rows="3"
                placeholder="Escribe tu comentario aquí..." required></textarea>
        </div>
        <div class="d-flex justify-content-end gap-2">
            <button type="button" id="cancelButton" class="btn btn-secondary btn-sm">Cancelar</button>
            <button type="submit" id="submitButton" class="btn btn-primary btn-sm">Comentar</button>
        </div>
    </form>

    <script>
        document.getElementById('cancelButton').addEventListener('click', function() {
            const text = document.getElementById('commentContent');
            text.value = ""; // Limpia el textarea
        });
    </script>
</div>
