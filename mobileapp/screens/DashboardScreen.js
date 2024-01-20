import React, { useLayoutEffect, useState } from 'react';
import { createBottomTabNavigator } from '@react-navigation/bottom-tabs';
import { View, Text, TouchableOpacity, Modal, StyleSheet, ImageBackground } from 'react-native';
import { FontAwesome5 } from '@expo/vector-icons';
import BookingsScreen from './BookingsScreen';
import CustomerScreen from './CustomerScreen';
import PaymentScreen from './PaymentScreen';


import { useFocusEffect } from '@react-navigation/native';

const DataCard = ({ title, value }) => (
  <View style={styles.dataCard}>
    <Text style={styles.dataCardTitle}>{title}</Text>
    <Text style={styles.dataCardValue}>{value}</Text>
  </View>
);

const Tab = createBottomTabNavigator();

const DashboardScreen = ({ navigation }) => {
  const [isLogoutModalVisible, setLogoutModalVisible] = useState(false);
  const [showLogoutButton, setShowLogoutButton] = useState(false);
  const backgroundImage = require("../assets/bg.png").default;


  console.log('Background Image Path:', backgroundImage);

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

  useLayoutEffect(() => {
    navigation.setOptions({
      headerLeft: () => null,
    });
  }, [navigation]);

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
    <ImageBackground source={require("../assets/bg.png")} style={styles.backgroundImage}>
    {/* ... rest of the code ... */}
  
  
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
    </ImageBackground>
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
  backgroundImage: {
    flex: 1,
    resizeMode: "cover",
    justifyContent: "center",
  },
});

const DashboardContent = () => {
  return (
    <View>
      <View style={styles.dataCardContainer}>
        {/* Custom data cards */}
        <DataCard title="Total Bookings" value="25" />
        <DataCard title="Total Customers" value="50" />
        <DataCard title="Total Revenue" value="$5000" />
      </View>
    </View>
  );
};

export default DashboardScreen;
