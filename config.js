'use strict';

// eslint-disable-next-line no-unused-vars
const config = {
  style: 'mapbox://styles/canagig/ckv4ib5425pot14o6shn1e64g',
  accessToken:
    'pk.eyJ1IjoiY2FuYWdpZyIsImEiOiJja3V6dzdtNWYydGExMndvZG12NThqbmpkIn0._qXSCKmbH3kafrivy_7o9w',
  CSV: 'Sample_Data.csv',
  center: [-101.871088,36.717658],
  zoom: 3,
  title: 'Search CITY to see jobs near you. \n Click filter to show FEATURED jobs.',
  description: '',
  sideBarInfo: ['Title', 'Company', 'Location'],
  popupInfo: ['Company Logo', 'Title', 'Company', 'Job Type', 'Salary', 'Location', 'Posting Date', 'Job Details Link'],
  filters: [
    {
      type: 'dropdown',
      title: 'Featured Company: ',
      columnHeader: 'Company',
      listItems: [
        'Amuse',
        'Holistic Industries',
      ],
    },
    {
      type: 'checkbox',
      title: 'Featured Jobs: ',
      columnHeader: 'Featured Jobs', // Case sensitive - must match spreadsheet entry
      listItems: ['Yes'], // Case sensitive - must match spreadsheet entry; This will take up to six inputs but is best used with a maximum of three;
    },
    {
      type: 'checkbox',
      title: 'Remote Jobs: ',
      columnHeader: 'Remote', // Case sensitive - must match spreadsheet entry
      listItems: ['Yes'], // Case sensitive - must match spreadsheet entry; This will take up to six inputs but is best used with a maximum of three;
    },
  ],
};
