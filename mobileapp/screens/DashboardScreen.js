import React, { useLayoutEffect, useState } from 'react';
import { createBottomTabNavigator } from '@react-navigation/bottom-tabs';
import { View, Text, TouchableOpacity, Modal, StyleSheet } from 'react-native';
import { FontAwesome5 } from '@expo/vector-icons';
import BookingsScreen from './BookingsScreen';
import CustomerScreen from './CustomerScreen';
import PaymentScreen from './PaymentScreen';

import { useFocusEffect } from '@react-navigation/native';

const Tab = createBottomTabNavigator();

const DashboardScreen = ({ navigation }) => {
  const [isLogoutModalVisible, setLogoutModalVisible] = useState(false);
  const [showLogoutButton, setShowLogoutButton] = useState(false);

  useLayoutEffect(() => {
    navigation.setOptions({
      headerRight: () => (
        <TouchableOpacity onPress={() => setLogoutModalVisible(true)}>
        {showLogoutButton && (
          <FontAwesome5 name="sign-out-alt" color="blue" size={24} style={{ marginRight: 15 }} />
        )}
      </TouchableOpacity>
      
      ),
    });
  }, [navigation, setLogoutModalVisible, showLogoutButton]);

  // Use useFocusEffect to detect screen focus
  useFocusEffect(() => {
    // When the screen is focused, show the logout button
    setShowLogoutButton(true);

    // Return a cleanup function to hide the button when the screen loses focus
    return () => setShowLogoutButton(false);
  });

  const handleLogout = () => {
    // Implement your logout logic here
    // After logout, navigate to the login screen
    navigation.navigate('Login'); // Replace 'Login' with the actual name of your login screen
  };

  return (
    <View style={{ flex: 1 }}>
      {/* Your tab navigator here */}
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
        {/* Other tab screens */}
        <Tab.Screen
          name="Bookings"
          component={BookingsScreen}
          options={{
            tabBarIcon: ({ color, size }) => (
              <FontAwesome5 name="calendar" color={color} size={size} />
            ),
          }}
        />

        
        <Tab.Screen
          name="Customers"
          component={CustomerScreen}
          options={{
            tabBarIcon: ({ color, size }) => (
              <FontAwesome5 name="users" color={color} size={size} />
            ),
          }}
        />
        <Tab.Screen
          name="Payments"
          component={PaymentScreen}
          options={{
            tabBarIcon: ({ color, size }) => (
              <FontAwesome5 name="credit-card" color={color} size={size} />
            ),
          }}
        />

       
      </Tab.Navigator>

      {/* Logout Confirmation Popup */}
      <Modal transparent={true} visible={isLogoutModalVisible} animationType="slide">
        <View style={styles.modalContainer}>
          <View style={styles.modalContent}>
            <Text>Are you sure you want to logout?</Text>
            <View style={styles.buttonContainer}>
              <TouchableOpacity onPress={handleLogout}>
                <Text style={styles.logoutButton}>Logout</Text>
              </TouchableOpacity>
              <TouchableOpacity onPress={() => setLogoutModalVisible(false)}>
                <Text style={styles.cancelButton}>Cancel</Text>
              </TouchableOpacity>
            </View>
          </View>
        </View>
      </Modal>
    </View>
  );
};

const styles = StyleSheet.create({
  modalContainer: {
    flex: 1,
    justifyContent: 'center',
    alignItems: 'center',
  },
  modalContent: {
    backgroundColor: 'white',
    padding: 20,
    borderRadius: 10,
    elevation: 5,
  },
  buttonContainer: {
    flexDirection: 'row',
    justifyContent: 'space-between',
    marginTop: 10,
  },
  logoutButton: {
    color: 'red',
  },
  cancelButton: {
    color: 'blue',
  },
});

const DashboardContent = () => {
  return (
    <View>
      <Text>Welcome to the Dashboard!</Text>
    </View>
  );
};

export default DashboardScreen;
