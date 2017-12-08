#!/usr/bin/env python

import json
import sys
from pprint import pprint

with open('_tmp/json_backup.json') as f1:
	all_data = json.load(f1)

with open('_tmp/filtered.json') as f2:
	filtered_data = json.load(f2)

# all_data_set = set(all_data)
# filtered_data_set = set(filtered_data)

intersected = []
for entry in all_data:
	def filterthings():
		for entry_filtered in filtered_data:
			pprint(filtered_data)
			if entry['attributes']['id'] == entry_filtered['attributes']['id']:
				intersected.append(entry)
				return


# intersected = all_data_set & filtered_data_set

# pprint(intersected)


# def combineLists(list_of_lists):

#         list_of_sets = []
        
#         #convert each dataset in list_of_lists to a set
#         for data_list in list_of_lists:

#                 location_set = set()
                
#                 for location in data_list:

#                         location_set.add(location)

#                 list_of_sets.append(location_set)

#         #intersect all the sets
#         uber_set = list_of_sets[0]
        
#         for location_set in list_of_sets:
#                 uber_set = uber_set.intersection_update(location_set)


#         #now convert that uberset back to a list and return it to php
#         location_list = []
        
#         for location in uber_set:
#                 location_list.append(location)

        
