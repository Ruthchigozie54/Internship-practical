// Global tracking variable for the active note card
let activeNoteElement = null;

/**
 * 1. Select and load note into reading pane
 */
function selectMessage(element) {
    const items = document.querySelectorAll('.message-item');
    items.forEach(item => item.classList.remove('active'));
    
    element.classList.add('active');
    activeNoteElement = element;

    const itemTime = element.querySelector('.item-time').innerText;
    const hiddenBodyContent = element.querySelector('.hidden-body').value;

    const displayDate = document.getElementById('display-date');
    const displayBody = document.getElementById('display-body');

    displayDate.innerText = `Today at ${itemTime}`;
    // Preserves linebreaks when displaying text inside the editor
    displayBody.innerText = hiddenBodyContent;
}

/**
 * 2. Real-Time Sidebar Synchronization
 */
document.getElementById('display-body').addEventListener('input', function() {
    if (!activeNoteElement) return;

    const fullText = this.innerText;
    
    // Sync the underlying textarea data array
    activeNoteElement.querySelector('.hidden-body').value = fullText;

    // Break lines to distinguish between Title and Subtext Preview
    const lines = fullText.split('\n').filter(line => line.trim() !== '');
    const titleElement = activeNoteElement.querySelector('.item-title');
    const previewElement = activeNoteElement.querySelector('.item-preview');

    if (lines.length > 0) {
        titleElement.innerText = lines[0];
        previewElement.innerText = lines[1] ? lines[1] : "No additional text";
    } else {
        titleElement.innerText = "New Note";
        previewElement.innerText = "No additional text";
    }
});

/**
 * 3. Create "New Note" Dynamic Component Injection
 */
document.getElementById('new-note-btn').addEventListener('click', () => {
    const listContainer = document.querySelector('.list-scrollable');
    
    // Grab local machine hours/minutes for dynamic timestamping
    const now = new Date();
    const currentTime = `${String(now.getHours()).padStart(2, '0')}:${String(now.getMinutes()).padStart(2, '0')}`;

    // Construct the standard note block structure matching your layout
    const newNoteHTML = `
        <div class="message-item" onclick="selectMessage(this)">
            <div class="item-title">New Note</div>
            <div class="item-meta">
                <span class="item-time">${currentTime}</span>
                <span class="item-preview">No additional text</span>
            </div>
            <textarea class="hidden-body">New Note</textarea>
        </div>
    `;

    // Insert the new note right at the top of the scroll list panel
    listContainer.insertAdjacentHTML('afterbegin', newNoteHTML);

    // Automatically click and shift focus straight to the newly added note block
    const targetNewNote = listContainer.querySelector('.message-item');
    targetNewNote.click();

    // Place the cursor focus inside the editor immediately for quick typing
    const editor = document.getElementById('display-body');
    editor.focus();
});

/**
 * 4. Delete Active Note Event Listener
 */
document.getElementById('delete-note-btn').addEventListener('click', () => {
    if (!activeNoteElement) {
        alert("Please select a note to delete first!");
        return;
    }

    // Capture sibling references to retain focus elsewhere post-deletion
    const nextToSelect = activeNoteElement.nextElementSibling || activeNoteElement.previousElementSibling;

    // Drop the active item block out of the layout hierarchy
    activeNoteElement.remove();
    activeNoteElement = null;

    // Shift window view to next closest remaining note or reset the display pane completely
    if (nextToSelect && nextToSelect.classList.contains('message-item')) {
        nextToSelect.click();
    } else {
        document.getElementById('display-date').innerText = "Select a note";
        document.getElementById('display-body').innerText = "Click a note from the left panel to view it.";
    }
});

/**
 * Application Runtime Init
 */
document.addEventListener("DOMContentLoaded", () => {
    const firstItem = document.querySelector('.message-item');
    if (firstItem) {
        firstItem.click();
    }
});