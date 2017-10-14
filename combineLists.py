#!/usr/bin/env python

import json

def combineLists(list_of_lists):

        list_of_sets = []
        
        #convert each dataset in list_of_lists to a set
        for data_list in list_of_lists:

                location_set = set()
                
                for location in data_list:

                        location_set.add(location)

                list_of_sets.append(location_set)

        #intersect all the sets
        uber_set = list_of_sets[0]
        
        for location_set in list_of_sets:
                uber_set = uber_set.intersection_update(location_set)


        #now convert that uberset back to a list and return it to php
        location_list = []
        
        for location in uber_set:
                location_list.append(location)

        
