function getArrayValue(data, path, level) {
    let index = level + 1;
    let key = path[index]
    if (!window._.isArray(data)) {
        return [data[key]];
    }
    let allData = data.map((item) => {
        let itemData = item[key]
        if (window._.isArray(itemData)) {
            return getArrayValue(itemData, path, index)
        } else {
            return itemData;
        }
    })
    return allData;
}

export {
    getArrayValue
}
