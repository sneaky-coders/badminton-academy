import React, { useLayoutEffect, useState } from 'react';
import { createBottomTabNavigator } from '@react-navigation/bottom-tabs';
import { View, Text, TouchableOpacity, Modal, StyleSheet, ImageBackground } from 'react-native';
import { FontAwesome5 } from '@expo/vector-icons';
import BookingsScreen from './BookingsScreen';
import CustomerScreen from './CustomerScreen';
import PaymentScreen from './PaymentScreen';
import { useFocusEffect } from '@react-navigation/native';

// New DataCard component with icons
const DataCard = ({ title, value, icon }) => (
  <View style={styles.dataCard}>
    <FontAwesome5 name={icon} size={24} color="#3498db" style={styles.dataCardIcon} />
    <Text style={styles.dataCardTitle}>{title}</Text>
    <Text style={styles.dataCardValue}>{value}</Text>
  </View>
);

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
      headerLeft: () => null,
    });
  }, [navigation, setLogoutModalVisible, showLogoutButton]);

  useFocusEffect(() => {
    setShowLogoutButton(true);

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
          name="Bookings"
          component={BookingsScreen}
          options={{
            tabBarIcon: ({ color, size }) => (
              <FontAwesome5 name="calendar" color={color} size={size} />
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

// Styles for the DashboardScreen
const styles = StyleSheet.create({
    backgroundImage: {
        flex: 1,
        resizeMode: 'cover',
      },
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
        justifyContent: 'space-around',
        marginTop: 10,
      },
      logoutButton: {
        color: 'red',
        fontSize: 16,
      },
      cancelButton: {
        color: 'blue',
        fontSize: 16,
      },
      dataCardContainer: {
        flexDirection: 'row',
        justifyContent: 'space-around',
        marginTop: 20,
      },
      dataCard: {
        backgroundColor: 'white',
        padding: 15,
        borderRadius: 10,
        elevation: 5,
        marginBottom: 20,
      },
      dataCardTitle: {
        fontSize: 16,
        fontWeight: 'bold',
        marginBottom: 5,
      },
      dataCardValue: {
        fontSize: 18,
      },
    
      dataCardContainer: {
        flexDirection: 'row',
        justifyContent: 'space-around',
        marginTop: 20,
      },
      dataCard: {
        backgroundColor: 'white',
        padding: 15,
        borderRadius: 10,
        elevation: 5,
        marginBottom: 20,
        alignItems: 'center',
      },
      dataCardIcon: {
        marginBottom: 10,
      },
      dataCardTitle: {
        fontSize: 16,
        fontWeight: 'bold',
        color: '#333',
      },
      dataCardValue: {
        fontSize: 18,
        color: '#3498db',
      },

  dataCardContainer: {
    flexDirection: 'row',
    flexWrap: 'wrap',
    justifyContent: 'space-around',
    marginTop: 20,
  },
  dataCard: {
    width: '48%', // Adjust the width to allow space for margins
    backgroundColor: 'white',
    padding: 15,
    borderRadius: 10,
    elevation: 5,
    marginBottom: 20,
    alignItems: 'center',
  },
  dataCardIcon: {
    marginBottom: 10,
  },
  dataCardTitle: {
    fontSize: 16,
    fontWeight: 'bold',
    color: '#333',
  },
  dataCardValue: {
    fontSize: 18,
    color: '#3498db',
  },
});

// DashboardContent component
const DashboardContent = () => {
  const backgroundImage = require("../assets/bg2.jpg");
  return (
    <ImageBackground source={backgroundImage} style={styles.backgroundImage}>
      <View>
        <View style={styles.dataCardContainer}>
          {/* Custom data cards */}
          <DataCard title="Total Bookings" value="25" icon="book" />
          <DataCard title="Total Customers" value="50" icon="users" />
          <DataCard title="Total Revenue" value="$5000" icon="dollar-sign" />
          <DataCard title="Paid Bookings" value="$5000" icon="info" />
          {/* Add more DataCard components as needed */}
        </View>
      </View>
    </ImageBackground>
  );
};

export default DashboardScreen;
