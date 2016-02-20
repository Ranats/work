var item = '';

var xhr = new XMLHttpRequest();
xhr.onreadystatechange = function (data) {
    if (xhr.readyState == 4) {
        if (xhr.status == 200) {
            var contents = xhr.responseText;
            // xhr.responseTextが取得したHTMLなど
            var dom = document.createElement("dom");
            dom.innerHTML = contents;
            if (contents.match(/Amazon/)) {
                var title = dom.getElementsByTagName('span');
                for (i = 0; i < title.length; i++) {
                    if (title[i].id == "productTitle") {
                        document.getElementById('hello').innerText = title[i].innerText;
                        item = title[i].innerHTML;
                        xhr.open('GET', 'http://search.shopping.yahoo.co.jp/search?ei=UTF-8&p=' + encodeURIComponent(item) + '&va=&ve=&tab_ex=commerce&oq=&cid=&pf=&pt=&used=0&seller=0&X=2', true);
                        xhr.send();
                    }
                }
            } else if (contents.match(/yahoo/)) {
                var price = dom.getElementsByClassName('price')[0];
                document.getElementById('yahoo_price').innerText = price.innerText;//.replace(/(<em>|<\/em>)/g,"");
                xhr.open('GET', 'http://search.rakuten.co.jp/search/mall/' + encodeURIComponent(item) + '/?s=2&grp=product&x=0', true);
                xhr.send();
            } else {
                var price = dom.getElementsByClassName('price')[1];
                document.getElementById('rakuten_price').innerText = price.innerText.replace(/送料込/, "");
            }

        }
    }
};

var res_div = document.querySelector('#res_div');

chrome.tabs.getSelected(null, function (tab) {
    xhr.open('GET', tab.url, true);
    xhr.send();
})

