<x-layout>
    <article class="paddingContainer" id="confirm-delete-container">

        <h1>Delete Category: {{ $category->name }}</h1>
        
        <div class="warning">
            <img class="warningIcon" src="{{ asset('images/warning.svg') }}">
            <div> 
                <p><strong>Warning:</strong> This category has {{ $category->products->count() }} associated products.</p>
                <p>Please choose what you want to do with these products:</p>
            </div>
        </div>
        
        <form method="post" action="{{ route('categories.destroy', $category) }}">
            @csrf
            @method('DELETE')
            
            <div class="options">
                <h2>Options for Associated Products</h2>
                
                <div class="option">
                    <input type="radio" id="orphan" name="action" value="orphan">
                    <label for="orphan">
                        <strong>Make products uncategorized</strong>
                        <p>Products will remain in the system but won't belong to any category.</p>
                    </label>
                </div>
                
                <div class="option">
                    <input type="radio" id="reassign" name="action" value="reassign">
                    <label for="reassign">
                        <strong>Move products to another category</strong>
                    </label>
                    
                    <div class="sub-option" id="reassign-options" style="margin-left: 20px; display: none;">
                        <label for="new_category_id">Select category:</label>
                        <select name="new_category_id" id="new_category_id">
                            @foreach($otherCategories as $otherCategory)
                                <option value="{{ $otherCategory->id }}">{{ $otherCategory->name }}</option>
                            @endforeach
                        </select>
                        
                        @if($otherCategories->isEmpty())
                            <p class="error">No other categories available. Please create another category first or choose a different option.</p>
                        @endif
                    </div>
                </div>
                
                <div class="option">
                    <input type="radio" id="delete" name="action" value="delete">
                    <label for="delete">
                        <strong>Delete all associated products</strong>
                        <div class="hide-warning warning">
                            <img class="warningIcon" src="{{ asset('images/warning.svg') }}">
                            <p class=>This will permanently delete all products in this category.</p>
                        </div>
                    </label>
                </div>
                
                <div class="option">
                    <input type="radio" id="cancel" name="action" value="cancel">
                    <label for="cancel">
                        <strong>Cancel</strong>
                        <p>Return to category without deleting it.</p>
                    </label>
                </div>
            </div>
            
            <div class="actions">
                <button type="submit" class="delete-btn">Confirm Action</button>
                <a href="{{ route('categories.show', $category) }}" class="cancel-btn">Go Back</a>
            </div>
        </form>
        
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const reassignRadio = document.getElementById('reassign');
                const reassignOptions = document.getElementById('reassign-options');
                
                if (reassignRadio.checked) {
                    reassignOptions.style.display = 'block';
                }
                
                document.querySelectorAll('input[name="action"]').forEach(function(radio) {
                    radio.addEventListener('change', function() {
                        reassignOptions.style.display = (reassignRadio.checked) ? 'block' : 'none';
                        
                        if (this.value === 'cancel') {
                            window.location.href = "{{ route('categories.show', $category) }}";
                        }
                    });
                });
            });
        </script>
    </article>
</x-layout>