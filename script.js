const piecesContainer = document.getElementById('pieces-container');
const dropZones = document.querySelectorAll('.drop-zone');
const resetButton = document.getElementById('reset-button');
const pieces = [
    'image1.png',
    'image2.png',
    'image3.png',
    'image4.png',
    'image5.png',
    'image6.png',
    'image7.png',
    'image8.png',
    'image9.png',
    'image10.png',
    'image11.png',
    'image12.png',
    'image13.png',
    'image14.png',
    'image15.png',
];

// Create puzzle pieces
function createPuzzlePieces() {
    pieces.forEach((piece, index) => {
        const div = document.createElement('div');
        div.className = 'puzzle-piece';
        div.style.backgroundImage = `url('image16.jpg')`; // Set the full image as background
        div.style.backgroundPosition = `-${(index % 5) * 100}px -${Math.floor(index / 5) * 100}px`; // Position pieces
        div.draggable = true;
        div.dataset.index = index; // Add data attribute for the index

        div.addEventListener('dragstart', (e) => {
            e.dataTransfer.setData('text/plain', index);
        });

        piecesContainer.appendChild(div);
    });
}

// Handle drop events
dropZones.forEach((zone) => {
    zone.addEventListener('dragover', (e) => {
        e.preventDefault(); // Allow drop
    });

    zone.addEventListener('drop', (e) => {
        const index = e.dataTransfer.getData('text/plain');
        const piece = piecesContainer.children[index];
        if (piece && !zone.hasChildNodes()) { // Check if the zone is empty
            zone.appendChild(piece); // Move piece to drop zone
        }
    });
});

// Reset game functionality
resetButton.addEventListener('click', () => {
    piecesContainer.innerHTML = ''; // Clear pieces
    createPuzzlePieces(); // Recreate pieces
});

// Initialize the game
createPuzzlePieces();