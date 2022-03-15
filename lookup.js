document.querySelector("#download-file").addEventListener('click', async function() {
	try {
		let text_data = await downloadFile();
		document.querySelector("#preview-text").textContent = text_data;
	}
	catch(e) {
		alert(e.message);
	}
});

async function downloadFile() {
	let response = await fetch("https://westtndave.github.io/WestTNDave/loadtest.txt");
		
	if(response.status != 200) {
		throw new Error("Server Error");
	}
		
	// read response stream as text
	let text_data = await response.text();

	return text_data;
}
