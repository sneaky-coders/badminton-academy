import React from 'react';
import { createBottomTabNavigator } from '@react-navigation/bottom-tabs';
import { View, Text } from 'react-native';
import { FontAwesome5 } from '@expo/vector-icons'; // Assuming you're using Expo, if not, adjust accordingly
import BookingsScreen from './BookingsScreen';

const Tab = createBottomTabNavigator();

const DashboardScreen = () => {
  return (
    <Tab.Navigator>
      <Tab.Screen
        name="Dashboard"
        component={DashboardContent}
        options={{
          tabBarIcon: ({ color, size }) => (
            <FontAwesome5 name="home" color={color} size={size} />
          ),
        }}
      />
      <Tab.Screen
        name="Bookings"
        component={BookingsScreen}
        options={{
          tabBarIcon: ({ color, size }) => (
            <FontAwesome5 name="calendar" color={color} size={size} />
          ),
        }}
      />
    </Tab.Navigator>
  );
};

const DashboardContent = () => {
  return (
    <View>
      <Text>Welcome to the Dashboard!</Text>
    </View>
  );
};

export default DashboardScreen;
