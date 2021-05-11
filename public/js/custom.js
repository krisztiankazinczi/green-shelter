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

const createMonthlyData = (dates) => {
  const xAxisLabels = [];
  const numberOfRequests = [0,0,0,0,0,0,0,0,0,0];
  let month = new Date().getMonth() + 1;
  let day = new Date().getDate();
  for (let i = 0; i < 10; i++) {
    if (day - 2 > 0) {
      xAxisLabels.push(`${month}.${day - 2} - ${month}.${day}`);
      day -= 3;
    } else {
      const newDay = day === 2 ? 30 : day === 1 ? 29 : 28
      xAxisLabels.push(`${month - 1}.${newDay} - ${month}.${day}`);
      day = newDay - 1;
      month--;
    }
  }
  dates.forEach(({ updated_at }) => {
    const requestDate = new Date(updated_at);
    const requestMonth = requestDate.getMonth() + 1;
    const requestDay = requestDate.getDate();
    const dateLabel = `${requestMonth}.${requestDay}`;
    xAxisLabels.forEach((label, index) => {
      const twoEndDate = label.split(' - ');
      if (twoEndDate[0].split('.')[1] === 30) {
        twoEndDate.push(`${+twoEndDate[0].split('.')[0] + 1}.1`);
      } else {
        twoEndDate.push(`${twoEndDate[0].split('.')[0]}.${+twoEndDate[0].split('.')[1] + 1}`)
      }

      if (twoEndDate.includes(dateLabel)) numberOfRequests[index] += 1;
    });
  })
  return {
    xLabels: xAxisLabels.reverse(),
    numberOfRequests: numberOfRequests.reverse()
  }
}

const createYearlyData = (dates) => {
  const xAxisLabels = ['Január', 'Február', 'Március', 'Április', 'Május', 'Június', 'Július', 'Augusztus', 'Szeptember', 'Október', 'November', 'December'];
  const numberOfRequests = [0,0,0,0,0,0,0,0,0,0,0,0];

  dates.forEach(({ updated_at }) => {
    const requestMonth = new Date(updated_at).getMonth();
    numberOfRequests[requestMonth] += 1
  })
  let month = new Date().getMonth() + 1;
  const labelSplice = xAxisLabels.splice(0, month);
  const requestSplice = numberOfRequests.splice(0, month);
  return {
    xLabels: [...xAxisLabels, ...labelSplice],
    numberOfRequests: [...numberOfRequests, ...requestSplice]
  }
}

const generateChart = (title, chartData, requestsCanvas) => {
  Chart.defaults.global.defaultFontFamily = "Lato";
  Chart.defaults.global.defaultFontSize = 18;

  let xAxisLabels;
  let numberOfRequests;
  if (chartData.period === 'week') {
    const result = createWeeklyData(chartData.data);
    xAxisLabels = result.xLabels;
    numberOfRequests = result.numberOfRequests;
  } else if (chartData.period === 'month') {
    const result = createMonthlyData(chartData.data);
    xAxisLabels = result.xLabels;
    numberOfRequests = result.numberOfRequests;
  } else {
    // Yearly Chart Data
    const result = createYearlyData(chartData.data);
    xAxisLabels = result.xLabels;
    numberOfRequests = result.numberOfRequests;
  }

  var requestData = {
    label: title + ' száma (db)',
    data: numberOfRequests,
    backgroundColor: 'rgba(77, 167, 91, 0.6)',
    borderWidth: 0,
    yAxisID: "number-of-requests"
    };

    var adoptionData = {
    labels: xAxisLabels,
    datasets: [requestData]
    };

    var chartOptions = {
        responsive: true,

    scales: {
        xAxes: [{
        barPercentage: 1,
        categoryPercentage: 0.6
        }],
        yAxes: [{
        id: "number-of-requests"
        }]
    }
    };

    var barChart = new Chart(requestsCanvas, {
    type: 'bar',
    data: adoptionData,
    options: chartOptions
    });



}