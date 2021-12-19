'use strict';

// eslint-disable-next-line no-unused-vars
const config = {
  style: 'mapbox://styles/canagig/ckv4ib5425pot14o6shn1e64g',
  accessToken:
    'pk.eyJ1IjoiY2FuYWdpZyIsImEiOiJja3V6dzdtNWYydGExMndvZG12NThqbmpkIn0._qXSCKmbH3kafrivy_7o9w',
  CSV: 'Sample_Data.csv',
  center: [-101.871088,36.717658],
  zoom: 3,
  title: '',
  description:
    '',
  sideBarInfo: ['Title', 'Company', 'City', 'State'],
  popupInfo: ['Title'],
  filters: [
    {
      type: 'dropdown',
      title: 'Company: ',
      columnHeader: 'Company',
      listItems: [
        'English',
        'French',
        'Portuguese',
        'Spanish',
      ],
    },
    {
      type: 'checkbox',
      title: 'Devices available: ',
      columnHeader: 'Devices_available', // Case sensitive - must match spreadsheet entry
      listItems: ['Computer', 'Wi-Fi', 'Adaptive Laptops'], // Case sensitive - must match spreadsheet entry; This will take up to six inputs but is best used with a maximum of three;
    },
    {
      type: 'dropdown',
      title: 'Clients: ',
      columnHeader: 'Clients',
      listItems: [
        'Adults',
        'Disabled',
        'Homeless',
        'Immigrants/Refugees',
        'Low Income',
        'Seniors',
        'Youth: Pre-teen',
        'Youth: Teen',
      ],
    },
  ],
};
