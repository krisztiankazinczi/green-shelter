// Search component's funtions
const redirectToSearchUrl = () => {
  const searchFor = document.getElementById('search-input');
  const filter_by = document.getElementById('filter_by');
  const order = document.getElementById('order');

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

// Hide send message modal on Info_card component 
const closeModal = (modal_id) => {
  $(`#${modal_id}`).modal('hide');
}

const closeMessageFromServer = () => {
  const serverMessage = document.getElementById('message-from-server');
  serverMessage.remove();

}

// Related to charts
const createWeeklyData = (dates) => {
  const xAxisLabels = [];
  const numberOfRequests = [0,0,0,0,0,0,0];
  let month = new Date().getMonth() + 1;
  let day = new Date().getDate();
  for (let i = 0; i < 7; i++) {
    xAxisLabels.push(`${month}.${day}`);
    if (day !== 1) {
      day--;
    } else {
      day = 30;
      month--;
    }
  }

  dates.forEach(({ updated_at }) => {
    const requestDate = new Date(updated_at);
    const dateLabel = `${requestDate.getMonth() + 1}.${requestDate.getDate()}`;
    const index = xAxisLabels.findIndex(label => label === dateLabel);
    if (index > -1) numberOfRequests[index] += 1;
  })
  return {
    xLabels: xAxisLabels.reverse(),
    numberOfRequests: numberOfRequests.reverse()
}
}