Highcharts.chart('container', {
  chart: {
    type: 'variablepie'
  },
  title: {
    text: 'Top selling products based on categories.'
  },
  tooltip: {
    headerFormat: '',
    pointFormat: '<span style="color:{point.color}">\u25CF</span> <b> {point.name}</b><br/>' +
      'Amount: <b>{point.y}</b><br/>' +
      'Product per category: <b>{point.z}</b><br/>'
  },
  series: [{
    minPointSize: 10,
    innerSize: '20%',
    zMin: 0,
    name: 'Products',
    data: [{
      name: 'TV',
      y: 20200,
      z: 92.9
    }, {
      name: 'Keyboards',
      y: 35340,
      z: 118.7
    }, {
      name: 'Skateboards',
      y: 31268,
      z: 124.6
    }, {
      name: 'Jeans',
      y: 7886,
      z: 137.5
    }, {
      name: 'Microwaves',
      y: 3013,
      z: 201.8
    }, {
      name: 'Avocados',
      y: 412,
      z: 214.5
    }, {
      name: 'Potatoes',
      y: 3570,
      z: 235.6
    }]
  }]
});
