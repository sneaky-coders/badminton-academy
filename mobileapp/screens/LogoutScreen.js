// LogoutScreen.js
import React, { useState } from 'react';
import { View, Text, TouchableOpacity, Modal, StyleSheet } from 'react-native';

const LogoutScreen = ({ navigation }) => {
  const [isModalVisible, setModalVisible] = useState(false);

  const handleLogout = () => {
    // Implement your logout logic here
    // After logout, navigate to the login screen
    navigation.navigate('Login'); // Replace 'Login' with the actual name of your login screen
  };

  return (
    <View style={{ flex: 1, justifyContent: 'center', alignItems: 'center' }}>
      <TouchableOpacity onPress={() => setModalVisible(true)}>
        <Text style={{ color: 'blue' }}>Logout</Text>
      </TouchableOpacity>

      <Modal transparent={true} visible={isModalVisible} animationType="slide">
        <View style={styles.modalContainer}>
          <View style={styles.modalContent}>
            <Text>Are you sure you want to logout?</Text>
            <View style={styles.buttonContainer}>
              <TouchableOpacity onPress={handleLogout}>
                <Text style={styles.logoutButton}>Logout</Text>
              </TouchableOpacity>
              <TouchableOpacity onPress={() => setModalVisible(false)}>
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

export default LogoutScreen;
