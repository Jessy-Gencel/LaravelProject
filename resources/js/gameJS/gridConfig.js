const gridConfig = {
    numRows: 5,
    numCols: 9,
    startOffsetx: 150,
    startOffsety: 150,
    bottomOffset: 50,
    rightOffset: 50,
    get availableWidth() {
        return window.innerWidth - this.startOffsetx - this.rightOffset;
    },
    get squareWidth() {
        return this.availableWidth / this.numCols;
    },
    get squareHeight() {
        return (window.innerHeight - this.startOffsety - this.bottomOffset) / this.numRows;
    }
};

export { gridConfig };