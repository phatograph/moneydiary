// shimprove v1.0.1 MIT @jon_neal
/*@cc_on@if(@_jscript_version<9)
(function (document) {
	var a = -1,
		html5_elements_array = 'abbr article aside audio canvas command datalist details figure figcaption footer header hgroup keygen mark meter nav output progress section source summary time video'.split(' '),
		attachEvent = 'attachEvent',
		createElement = 'createElement',
		length = 'length',
		onpropertychange = 'onpropertychange',
		documentFragment = document.createDocumentFragment(),
		documentCreateElement = document[createElement],
		newDocumentCreateElement = function (node) { // console.log('createElement, ' + node);
			node = documentFragment.appendChild(documentCreateElement(node));

			opc.apply(documentFragment);

			return node;
		},
		newCloneNode = function () { // console.log('cloneNode, ' + this.nodeName);
			var clone = document[createElement]('div');

			clone.innerHTML = this.outerHTML;

			clone = clone.firstChild;

			clone.cloneNode = newCloneNode;

			return clone;
		};

	while (++a < html5_elements_array[length]) {
		document[createElement](html5_elements_array[a]);
		documentFragment[createElement](html5_elements_array[a]);
	}

	document[createElement] = newDocumentCreateElement;

	function opc () {
		var instance = this.document || this,
			el = instance.getElementsByTagName('*'),
			a = -1;

		if (el[length] && el[length] != arguments.callee.elementsLength && (arguments.callee.elementsLength = el[length])) { // console.log('elementChange, ' + instance.nodeName);
			while (++a < el[length]) {
				el[a].cloneNode = newCloneNode;
			}
		}
	};

	document[attachEvent](onpropertychange, opc);
	documentFragment[attachEvent](onpropertychange, opc);
}(document));
@end@*/