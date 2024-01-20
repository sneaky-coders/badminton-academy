import React, { useLayoutEffect, useState } from 'react';
import { createBottomTabNavigator } from '@react-navigation/bottom-tabs';
import { View, Text, TouchableOpacity, Modal, StyleSheet, ImageBackground, StatusBar } from 'react-native';
import { FontAwesome5 } from '@expo/vector-icons';
import BookingsScreen from './BookingsScreen';
import CustomerScreen from './CustomerScreen';
import PaymentScreen from './PaymentScreen';
import SubMenu from './SubMenu';

const Tab = createBottomTabNavigator();

const DataCard = ({ title, value, icon }) => (
  <View style={styles.dataCard}>
    <FontAwesome5 name={icon} size={24} color="#3498db" style={styles.dataCardIcon} />
    <Text style={styles.dataCardTitle}>{title}</Text>
    <Text style={styles.dataCardValue}>{value}</Text>
  </View>
);

const DashboardScreen = ({ navigation }) => {
  const [isLogoutModalVisible, setLogoutModalVisible] = useState(false);
  const [showSubMenu, setShowSubMenu] = useState(false);

  useLayoutEffect(() => {
    navigation.setOptions({
      headerRight: () => (
        <View style={{ flexDirection: 'row', alignItems: 'center' }}>
          <TouchableOpacity onPress={() => setShowSubMenu(true)}>
            <FontAwesome5 name="cog" size={24} color="#3498db" style={{ marginRight: 15 }} />
          </TouchableOpacity>
        </View>
      ),
      headerLeft: () => null,
    });
  }, [navigation, setLogoutModalVisible, showSubMenu]);

  const handleLogout = () => {
    // Implement your logout logic here
    // After logout, navigate to the login screen
    navigation.navigate('Login'); // Replace 'Login' with the actual name of your login screen
  };

  const handleProfile = () => {
    // Implement navigation to the profile screen
     navigation.navigate('Profile'); // Uncomment and replace 'Profile' with the actual name of your profile screen
   
    setShowSubMenu(false);
  };

  const handleCloseSubMenu = () => {
    setShowSubMenu(false);
  };

  return (
    <View style={{ flex: 1 }}>
      <StatusBar barStyle="light-content" />
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

      {showSubMenu && (
        <SubMenu
          onClose={handleCloseSubMenu}
          onProfilePress={handleProfile}
          onLogoutPress={handleLogout}
        />
      )}

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
  dataCard: {
    width: '48%',
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
});

const DashboardContent = () => {
  const backgroundImage = require("../assets/bg2.jpg");
  return (
    <ImageBackground source={backgroundImage} style={{ flex: 1, resizeMode: 'cover' }}>
      <View style={{ flexDirection: 'row', flexWrap: 'wrap', justifyContent: 'space-around', marginTop: 20 }}>
        <DataCard title="Total Bookings" value="25" icon="book" />
        <DataCard title="Total Customers" value="50" icon="users" />
        <DataCard title="Total Revenue" value="$5000" icon="dollar-sign" />
        <DataCard title="Paid Bookings" value="$5000" icon="info" />
      </View>
    </ImageBackground>
  );
};

export default DashboardScreen;
