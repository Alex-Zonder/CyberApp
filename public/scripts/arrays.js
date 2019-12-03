class Arrays {
	cangeItemsByKeys(arr, first, seccond) {
		arr[seccond] = arr.splice(first, 1, arr[seccond])[0];
		return arr;
	}
}
arrays = new Arrays();
