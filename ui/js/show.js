function showTools(showTool,classToAdd){
    var toolDiv = document.getElementById(showTool);
    toolDiv.classList.add(classToAdd);
}
function closeTools(closeTool,classToMove){
    var toolDivClose = document.getElementById(closeTool);
    toolDivClose.classList.remove(classToMove);
}