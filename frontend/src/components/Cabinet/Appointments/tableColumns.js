import {formatSlotTime} from "src/utils/format";

export default [
  {
    name: 'id',
    label: 'ID',
    align: 'left',
    field: row => row.id,
    format: val => val,
    required: true,
    sortable: true,
  },
  {
    name: 'client',
    label: 'Client',
    align: 'left',
    field: row => row.client,
    format: val => `${val.name} ${val.surname}`,
    required: true,
    sortable: true,
  },
  {
    name: 'time',
    label: 'Time',
    align: 'left',
    field: row => formatSlotTime(row.time[0].exactDate, row.time[0].exactTimeInMinutes),
    format: val => val,
    required: true,
    sortable: true,
  },
  {
    name: 'contactType',
    label: 'Contact Type',
    align: 'left',
    field: row => row.clientContactType,
    format: val => val,
    required: true,
    sortable: true,
  },
  {
    name: 'status',
    label: 'Status',
    align: 'left',
    field: row => row.status.label,
    format: val => val,
    required: true,
    sortable: true,
  },
];
