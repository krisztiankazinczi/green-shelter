const redirectToSearchUrl = () => {
  const searchFor = document.getElementById('search-input');
  const filter_by = document.getElementById('filter_by');
  const order = document.getElementById('order');
  console.log(searchFor.value);
  console.log(filter_by.value);
  console.log(order.value);
  const newUrl = createUrlFromSearchParams(
    searchFor.value, 
    filter_by.value, 
    order.value
  )
  window.location.replace(newUrl);
}

const createUrlFromSearchParams = (searchFor, filter_by, order) => {
  let newUrl = window.location.href.split('?')[0] + '?';
  if (searchFor) newUrl += 't=' + searchFor + '&';
  if (filter_by) newUrl += 'filter=' + filter_by + '&';
  if (order) newUrl += 'order=' + order;
  return newUrl;
}