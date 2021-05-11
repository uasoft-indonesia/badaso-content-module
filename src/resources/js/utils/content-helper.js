export default {
  isMultipleFields(field) {
    return field.type === 'group';
  },
  stringToJson(string) {
    return string.replace(/\s+/g, '').trim()
  },
  getTypeContent() {
    return [
      {
        label: "Text",
        value: "text"
      },
      {
        label: "Image",
        value: "image"
      },
      {
        label: "URL",
        value: "url"
      },
    ]
  },
  getAllTypeContent() {
    return [
      {
        label: "Text",
        value: "text"
      },
      {
        label: "Image",
        value: "image"
      },
      {
        label: "URL",
        value: "url"
      },
      {
        label: "Group",
        value: "group",
      }
    ]
  },
  getRandomColor() {
    var letters = 'BCDEF'.split('');
    var color = '#';
    for (var i = 0; i < 6; i++ ) {
        color += letters[Math.floor(Math.random() * letters.length)];
    }
    return color;
  }
}