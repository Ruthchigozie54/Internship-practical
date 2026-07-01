// Global tracking variables
let activeNoteElement = null;
let activeNoteId = null;
let saveTimeout = null;

/**
 * 1. Select and load note into reading pane
 */
function selectMessage(element) {
    const items = document.querySelectorAll('.message-item');
    items.forEach(item => item.classList.remove('active'));

    element.classList.add('active');
    activeNoteElement = element;
    activeNoteId = element.getAttribute('data-id'); // Read primary key identifier

    const itemTime = element.querySelector('.item-time').innerText;
    const hiddenBodyContent = element.querySelector('.hidden-body').value;

    const displayDate = document.getElementById('display-date');
    const displayBody = document.getElementById('display-body');

    displayDate.innerText = `Today at ${itemTime}`;
    displayBody.innerText = hiddenBodyContent;
}

/**
 * 2. Real-Time Sidebar Synchronization & Debounced Auto-Save
 */
document.getElementById('display-body').addEventListener('input', function () {
    if (!activeNoteElement || !activeNoteId) return;

    const fullText = this.innerText;

    // Immediate local DOM UI syncing
    activeNoteElement.querySelector('.hidden-body').value = fullText;

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

    // Debounce System: Clear previous timer and reset waiting period
    clearTimeout(saveTimeout);
    saveTimeout = setTimeout(() => {
        const formData = new FormData();
        formData.append('id', activeNoteId);
        formData.append('body', fullText);

        fetch('update_note.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                activeNoteElement.querySelector('.item-time').innerText = data.timestamp;
                document.getElementById('display-date').innerText = `Today at ${data.timestamp}`;
            }
        });
    }, 400); // Wait for 400ms pause in typing before hitting MySQL
});

/**
 * 3. Create "New Note" via Backend Request
 */
document.getElementById('new-note-btn').addEventListener('click', () => {
    fetch('create_note.php', { method: 'POST' })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const listContainer = document.querySelector('.list-scrollable');

            const newNoteHTML = `
                <div class="message-item" data-id="${data.id}" onclick="selectMessage(this)">
                    <div class="item-title">New Note</div>
                    <div class="item-meta">
                        <span class="item-time">${data.timestamp}</span>
                        <span class="item-preview">No additional text</span>
                    </div>
                    <textarea class="hidden-body">New Note</textarea>
                </div>
            `;

            // Insert the new note right at the top of the scroll list panel
            listContainer.insertAdjacentHTML('afterbegin', newNoteHTML);

            // Automatically click to load it into the panel variables
            const targetNewNote = listContainer.querySelector('.message-item');
            targetNewNote.click();

            // Safe Async Focus Hook: Forces the browser to safely hand keyboard input to the editor
            setTimeout(() => {
                const editor = document.getElementById('display-body');
                editor.focus();
                
                // Optional: Place the cursor at the end of the text "New Note" instead of blocking it
                const range = document.createRange();
                const sel = window.getSelection();
                range.selectNodeContents(editor);
                range.collapse(false); // false means collapse to the end
                sel.removeAllRanges();
                sel.addRange(range);
            }, 50); 

        } else {
            alert("Failed to initialize a new note string in database.");
        }
    });
});

/**
 * 4. Delete Note from Layout & Database
 */
document.getElementById('delete-note-btn').addEventListener('click', () => {
    if (!activeNoteElement || !activeNoteId) {
        alert("Please select a note to delete first!");
        return;
    }

    const formData = new FormData();
    formData.append('id', activeNoteId);

    fetch('delete_note.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const nextToSelect = activeNoteElement.nextElementSibling || activeNoteElement.previousElementSibling;

            activeNoteElement.remove();
            activeNoteElement = null;
            activeNoteId = null;

            if (nextToSelect && nextToSelect.classList.contains('message-item')) {
                nextToSelect.click();
            } else {
                document.getElementById('display-date').innerText = "Select a note";
                document.getElementById('display-body').innerText = "Click a note from the left panel to view it.";
            }
        } else {
            alert("Could not remove note record.");
        }
    });
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

/* ====================================
   THEME SYSTEM
   ==================================== */
const themeSelector = document.getElementById("theme-selector");
if (themeSelector) {
    const savedTheme = localStorage.getItem("theme");
    if (savedTheme) {
        document.body.className = savedTheme;
        themeSelector.value = savedTheme;
    }
    themeSelector.addEventListener("change", function () {
        document.body.className = this.value;
        localStorage.setItem("theme", this.value);
    });
}